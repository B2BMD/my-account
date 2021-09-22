<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Tracking as TrackingResource;
use App\Models\CallApiCounter;
use App\Models\Tracking;
use Carbon\Carbon;
use FedEx\TrackService\ComplexType;
use FedEx\TrackService\Request as FedexTrackServiceRequest;
use FedEx\TrackService\SimpleType;
use Illuminate\Http\Request;
use Validator;

class TrackingController extends BaseController
{
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'case_number' => 'required',
            'shipment_provider' => 'required',
            'shipment_tracking_number' => 'required',
            'tracking_history' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $tracking = Tracking::create($input);

        return $this->sendResponse(new TrackingResource($tracking), 'Tracking created.');
    }

    public function show($id)
    {
        $tracking = Tracking::find($id);

        if (is_null($tracking)) {
            return $this->sendError('Tracking does not exist.');
        }

        return $this->sendResponse(new TrackingResource($tracking), 'Tracking fetched.');
    }

    public function history($shipment_provider, $shipment_tracking_number, $case_number)
    {
        if (is_null($shipment_provider) || is_null($shipment_tracking_number) || is_null($case_number)) {
            return $this->sendError('Missing Shipment Provider, Tracking Number or Case Number.');
        }

        $tracking =
            Tracking::where(['case_number' => $case_number, 'shipment_provider' => $shipment_provider, 'shipment_tracking_number' => $shipment_tracking_number])
                ->get();

        if (is_null($tracking) || empty($tracking->first()) || ($tracking->first()->updated_at->lt(Carbon::now()->subMinutes(5)))) {
            switch ($shipment_provider) {
                case 'USPS':
                    $history = $this->getUspsHistory($shipment_tracking_number);

                    break;
                case 'FEDEX':
                    $history = $this->getFedexHistory($shipment_tracking_number);

                    break;

                default:
                    // do nothing
                    break;
            }

            if (!empty($history) && !empty($history['TrackID'])) {
                if (is_object($tracking->first()) && !empty($tracking->first()->tracking_history)) {
                    $old_history = json_decode($tracking->first()->tracking_history, true);
                } else {
                    $old_history = null;
                }

                if ($old_history != $history) {
                    $geoTrackeable = !empty($history['Summary']) && (!empty($history['Summary']['EventCity']) && !empty($history['Summary']['EventState']) && !empty($history['Summary']['EventZIPCode']));
                    $geocoding_url_params = strtr(implode(',+', [$history['Summary']['EventCity'], $history['Summary']['EventState'], $history['Summary']['EventZIPCode']]), [' ' => '+']);
                    $geocoding_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$geocoding_url_params.'&key='.env('GOOGLE_MAPS_GEOCODING_API_KEY');

                    // @TODO BLOCK BEGIN: After get a valid key and it be configured on .env file, the next lines should be
                    // delete or comment
                    $geocoding = '{"results":[{"address_components":[{"long_name":"33408","short_name":"33408","types":["postal_code"]},{"long_name":"North Palm Beach","short_name":"North Palm Beach","types":["locality","political"]},{"long_name":"Palm Beach County","short_name":"Palm Beach County","types":["administrative_area_level_2","political"]},{"long_name":"Florida","short_name":"FL","types":["administrative_area_level_1","political"]},{"long_name":"United States","short_name":"US","types":["country","political"]}],"formatted_address":"North Palm Beach, FL 33408, USA","geometry":{"bounds":{"northeast":{"lat":26.893896,"lng":-80.0372249},"southwest":{"lat":26.7927429,"lng":-80.0815839}},"location":{"lat":26.8404331,"lng":-80.0590804},"location_type":"APPROXIMATE","viewport":{"northeast":{"lat":26.893896,"lng":-80.0372249},"southwest":{"lat":26.7927429,"lng":-80.0815839}}},"place_id":"ChIJ1zm01yTV2IgRQE9g8cRewSg","postcode_localities":["Juno Beach","North Palm Beach","Palm Beach Gardens","West Palm Beach"],"types":["postal_code"]}],"status":"OK"}';

                    CallApiCounter::updateOrCreate(
                        [
                            'api_provider' => 'GOOGLE_MAPS_GEOCODING',
                            'date' => date('Y-m-d'),
                        ]
                    );
                    CallApiCounter::where('api_provider', 'GOOGLE_MAPS_GEOCODING')->where('date', date('Y-m-d'))->increment('counter');

                // uncomment;
                    // $geocoding = file_get_contents($geocoding_url);

                    // @TODO BLOCK END
                } else {
                    $geocoding = $tracking->first()->geocoding;
                }

                Tracking::updateOrCreate(
                    [
                        'case_number' => $case_number,
                        'shipment_provider' => $shipment_provider,
                        'shipment_tracking_number' => $shipment_tracking_number,
                    ],
                    [
                        'tracking_history' => json_encode($history),
                        'geocoding' => !empty($geocoding) ? $geocoding : null,
                    ]
                );

                if (!empty($tracking->first())) {
                    $tracking->first()->touch();
                }

                return $this->sendResponse(['tracking_history' => $history, 'geocoding' => json_decode($geocoding, true)], 'Tracking fetched from '.$shipment_provider.'\'s API');
            }

            return $this->sendError(['tracking_history' => $history, 'geocoding' => null]);
        }

        return $this->sendResponse(['tracking_history' => json_decode($tracking->first()->tracking_history, true), 'geocoding' => json_decode($tracking->first()->geocoding, true)], 'Tracking fetched from cache.');

        return $this->sendError('Unknown error!');
    }

    public function update(Request $request, Tracking $tracking)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'courier_id' => 'required',
            'order_id' => 'required',
            'tracking_number' => 'required',
            'tracking_history' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $tracking->tracking_history = $input['tracking_history'];
        $tracking->save();

        return $this->sendResponse(new TrackingResource($tracking), 'Tracking updated.');
    }

    public function destroy(Tracking $tracking)
    {
        $tracking->delete();

        return $this->sendResponse([], 'Tracking deleted.');
    }

    /**
     * GET method.
     *
     * @param string $endpoint                 API endpoint
     * @param array  $parameters               request parameters
     * @param mixed  $shipment_tracking_number
     *
     * @return array
     */
    private function getUspsHistory($shipment_tracking_number)
    {
        $this->urlXMLRequest = '<TrackFieldRequest USERID="'.env('USPS_ACCOUNT_USER_ID').'">'.'<TrackID ID="'.$shipment_tracking_number.'"></TrackID></TrackFieldRequest>';
        $this->trackUrl = env('USPS_WEB_TOOLS_SERVER').env('USPS_URL_PATH').'?API='.env('USPS_URL_API').'&XML='.$this->urlXMLRequest;

        $xmlData = @simplexml_load_file($this->trackUrl, 'SimpleXMLElement', LIBXML_NOCDATA);

        if (false === $xmlData) {
            return ['status' => 'fail', 'error' => 'Error retrieving data.'];
        }

        $tmpArrayData = json_decode(json_encode($xmlData), true);

        if (!empty($tmpArrayData['TrackInfo'])) {
            $trackingInfo = [];
            $trackingInfo['TrackID'] = empty($tmpArrayData['TrackInfo']['@attributes']['ID']) ? null : $tmpArrayData['TrackInfo']['@attributes']['ID'];
            $trackingInfo['Summary'] = empty($tmpArrayData['TrackInfo']['TrackSummary']) ? null : $tmpArrayData['TrackInfo']['TrackSummary'];

            if (!empty($tmpArrayData['TrackInfo']['TrackDetail'])) {
                $trackingInfo['TrackDetail'] = $tmpArrayData['TrackInfo']['TrackDetail'];
            } else {
                $trackingInfo['TrackDetail'] = [];
            }
        }

        if (empty($trackingInfo['Summary']) && !empty($tmpArrayData['TrackInfo']['Error']['Description'])) {
            $trackingInfo['Summary'] = [];
            $trackingInfo['Summary']['EventTime'] = null;
            $trackingInfo['Summary']['EventDate'] = null;
            $trackingInfo['Summary']['Event'] = $tmpArrayData['TrackInfo']['Error']['Description'];
            $trackingInfo['Summary']['EventCity'] = null;
            $trackingInfo['Summary']['EventState'] = null;
            $trackingInfo['Summary']['EventZIPCode'] = null;
            $trackingInfo['Summary']['EventCountry'] = null;
            $trackingInfo['Summary']['DeliveryAttributeCode'] = null;
        }

        return !empty($trackingInfo) ? $trackingInfo : null;
    }

    private function getFedexHistory($shipment_tracking_number)
    {
        $trackRequest = new ComplexType\TrackRequest();

        $trackRequest->WebAuthenticationDetail->UserCredential->Key = env('FEDEX_KEY');
        $trackRequest->WebAuthenticationDetail->UserCredential->Password = env('FEDEX_PASSWORD');
        $trackRequest->ClientDetail->AccountNumber = env('FEDEX_ACCOUNT_NUMBER');
        $trackRequest->ClientDetail->MeterNumber = env('FEDEX_METER_NUMBER');

        $trackRequest->Version->ServiceId = 'trck';
        $trackRequest->Version->Major = 19;
        $trackRequest->Version->Intermediate = 0;
        $trackRequest->Version->Minor = 0;

        $trackRequest->SelectionDetails = [new ComplexType\TrackSelectionDetail()];

        $trackRequest->ProcessingOptions = [SimpleType\TrackRequestProcessingOptionType::_INCLUDE_DETAILED_SCANS];

        $trackRequest->SelectionDetails[0]->PackageIdentifier->Value = $shipment_tracking_number;
        $trackRequest->SelectionDetails[0]->PackageIdentifier->Type = SimpleType\TrackIdentifierType::_TRACKING_NUMBER_OR_DOORTAG;

        $request = new FedexTrackServiceRequest();
        $trackReply = $request->getTrackReply($trackRequest, true);
        // print_r($trackReply);die();

        if ('SUCCESS' === $trackReply->HighestSeverity) {
            $trackingInfo = [];

            $completedTrackDetails = $trackReply->CompletedTrackDetails;
            $trackingInfo['TrackID'] = $completedTrackDetails->TrackDetails->TrackingNumber;

            if ('SUCCESS' == $completedTrackDetails->TrackDetails->Notification->Severity) {
                $trackingInfo['Summary'] = [];
                $trackingInfo['Summary']['EventTime'] = null;
                $trackingInfo['Summary']['EventDate'] = $date = date_format(date_create($completedTrackDetails->TrackDetails->StatusDetail->CreationTime), 'F j, Y');
                $trackingInfo['Summary']['Event'] = (!empty($completedTrackDetails->TrackDetails->StatusDetail->Description) ? $completedTrackDetails->TrackDetails->StatusDetail->Description : '').' - '.(!empty($completedTrackDetails->TrackDetails->StatusDetail->AncillaryDetails->ReasonDescription) ? $completedTrackDetails->TrackDetails->StatusDetail->AncillaryDetails->ReasonDescription : '');
                $trackingInfo['Summary']['EventCity'] = !empty($completedTrackDetails->TrackDetails->StatusDetail->Location->City) ? $completedTrackDetails->TrackDetails->StatusDetail->Location->City : null;
                $trackingInfo['Summary']['EventState'] = !empty($completedTrackDetails->TrackDetails->StatusDetail->Location->StateOrProvinceCode) ? $completedTrackDetails->TrackDetails->StatusDetail->Location->StateOrProvinceCode : null;
                $trackingInfo['Summary']['EventZIPCode'] = null;
                $trackingInfo['Summary']['EventCountry'] = !empty($completedTrackDetails->TrackDetails->StatusDetail->Location->CountryName) ? $completedTrackDetails->TrackDetails->StatusDetail->Location->CountryName : null;
                $trackingInfo['Summary']['DeliveryAttributeCode'] = !empty($completedTrackDetails->TrackDetails->StatusDetail->AncillaryDetails->Reason) ? $completedTrackDetails->TrackDetails->StatusDetail->AncillaryDetails->Reason : null;
                $trackingInfo['TrackDetail'] = [];

                if (!empty($completedTrackDetails->TrackDetails->Events && is_array($completedTrackDetails->TrackDetails->Events))) {
                    foreach (array_reverse($completedTrackDetails->TrackDetails->Events) as $index => $event) {
                        $tmp = [];
                        $timeStamp = date_create($event->Timestamp);
                        $tmp['EventTime'] = date_format($timeStamp, 'g:i a');
                        $tmp['EventDate'] = date_format($timeStamp, 'F j, Y');
                        $tmp['Event'] = !empty($event->EventDescription) ? $event->EventDescription : null;
                        $tmp['EventCity'] = !empty($event->Address->City) ? $event->Address->City : null;
                        $tmp['EventState'] = !empty($event->Address->StateOrProvinceCode) ? $event->Address->StateOrProvinceCode : null;
                        $tmp['EventZIPCode'] = !empty($event->Address->PostalCode) ? $event->Address->PostalCode : null;
                        $tmp['EventCountry'] = !empty($event->Address->CountryName) ? $event->Address->CountryName : null;
                        $tmp['FirmName'] = [];
                        $tmp['Name'] = [];
                        $tmp['AuthorizedAgent'] = false;
                        $trackingInfo['TrackDetail'][] = $tmp;
                    }
                }

                return $trackingInfo;
            }

            return ['TrackID' => $completedTrackDetails->TrackDetails->TrackingNumber, 'Notifications' => $trackReply->CompletedTrackDetails->TrackDetails->Notification];
        }

        return ['TrackID' => null, 'Notifications' => $trackReply->Notifications];

        return null;
    }
}
