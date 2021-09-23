<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
// use App\Http\Resources\Tracking as TrackingResource;
// use App\Http\Resources\Geolocation as GeolocationResource;
use App\Models\CallApiCounter;
use App\Models\Geolocation;
use App\Models\Tracking;
use Carbon\Carbon;
use FedEx\TrackService\ComplexType;
use FedEx\TrackService\Request as FedexTrackServiceRequest;
use FedEx\TrackService\SimpleType;

class TrackingController extends BaseController
{
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
					$old_history = '';
				}

				if ($old_history != $history) {
					$geoTrackable = !empty($history['Summary']) && (!empty($history['Summary']['EventCity']) || !empty($history['Summary']['EventState']) || !empty($history['Summary']['EventZIPCode']));

					if ($geoTrackable) {
						$geolocation =
						Geolocation::where(['city' => $history['Summary']['EventCity'], 'state' => $history['Summary']['EventState'], 'zip_code' => $history['Summary']['EventZIPCode']])
							->get();

						if (!empty($geolocation) && is_object($geolocation->first()) && !empty($geolocation->first()->geocoding)) {
							$geocoding = $geolocation->first()->geocoding;
						} else {
							$geocoding_url_params = strtr(
								implode(
									',+',
									[
										!is_string($history['Summary']['EventCity']) ? null : $history['Summary']['EventCity'],
										!is_string($history['Summary']['EventState']) ? null : $history['Summary']['EventState'],
										!is_string($history['Summary']['EventZIPCode']) ? null : $history['Summary']['EventZIPCode'],
									]
								),
								[' ' => '+']
							);
							$geocoding_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$geocoding_url_params.'&key='.env('GOOGLE_MAPS_GEOCODING_API_KEY');

							$geocoding = file_get_contents($geocoding_url);
							$where = [
								'city' => !is_string($history['Summary']['EventCity']) ? null : $history['Summary']['EventCity'],
								'state' => !is_string($history['Summary']['EventState']) ? null : $history['Summary']['EventState'],
								'zip_code' => !is_string($history['Summary']['EventZIPCode']) ? null : $history['Summary']['EventZIPCode'],
							];
							$geolocation =
							Geolocation::updateOrCreate(
								$where,
								[
									'geocoding' => !empty($geocoding) ? $geocoding : '',
								]
							);
							// delete or comment, it's only for count how many calls we made to Google Maps Geocoding API
							CallApiCounter::updateOrCreate(['api_provider' => 'GOOGLE_MAPS_GEOCODING', 'date' => date('Y-m-d')]);
							CallApiCounter::where('api_provider', 'GOOGLE_MAPS_GEOCODING')->where('date', date('Y-m-d'))->increment('counter');
						}
					} else {
						$geocoding = '';
					}
				} else {
					$geolocation = Geolocation::where(['id' => $tracking->first()->geolocation_id])->get();
					$geocoding = (!empty($geolocation) && is_object($geolocation->first()) && !empty($geolocation->first()->geocoding)) ? $geolocation->first()->geocoding : null;
				}
				$geolocation_id =
				(
					(
						empty($geolocation) ? 1
						: (
							is_object($geolocation) ?
							('Illuminate\Database\Eloquent\Collection' == get_class($geolocation) ? (is_object($geolocation->first()) ? $geolocation->first()->id : 1) : 1)
							:
							('App\Models\Geolocation' == get_class($geolocation) ? $geolocation->id : 1)
						)
					)
				);

				Tracking::updateOrCreate(
					[
						'case_number' => $case_number,
						'shipment_provider' => $shipment_provider,
						'shipment_tracking_number' => $shipment_tracking_number,
					],
					[
						'tracking_history' => json_encode($history),
						'geolocation_id' => (!empty($geolocation) && is_object($geolocation->first()) && !empty($geolocation->first()->id)) ? $geolocation->first()->id : 1,
					]
				);

				if (is_object($tracking->first())) {
					$tracking->first()->touch();
				}

				return $this->sendResponse(['tracking_history' => $history, 'geocoding' => json_decode($geocoding, true)], 'Tracking fetched from '.$shipment_provider.'\'s API');
			}

			return $this->sendError(['tracking_history' => $history, 'geocoding' => null]);
		}
		$geolocation = Geolocation::where(['id' => $tracking->first()->geolocation_id])->get();
		$geocoding = (!empty($geolocation) && is_object($geolocation->first()) && !empty($geolocation->first()->geocoding)) ? $geolocation->first()->geocoding : null;

		return $this->sendResponse(['tracking_history' => json_decode($tracking->first()->tracking_history, true), 'geocoding' => json_decode($geocoding, true)], 'Tracking fetched from cache.');
		// return $this->sendError('Unknown error!');
	}

	/**
	 * GET method.
	 *
	 * @param string $shipment_tracking_number USPS Tracking number
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

			if (!empty($tmpArrayData['TrackInfo']['TrackSummary'])) {
				$trackingInfo['Summary'] = $tmpArrayData['TrackInfo']['TrackSummary'];
			} elseif (!empty($tmpArrayData['TrackInfo']['Error']['Description'])) {
				$trackingInfo['Summary'] = [];
				// $trackingInfo['Summary']['EventTime'] = null;
				// $trackingInfo['Summary']['EventDate'] = null;
				$trackingInfo['Summary']['Error'] = $tmpArrayData['TrackInfo']['Error']['Description'];
				// $trackingInfo['Summary']['EventCity'] = null;
				// $trackingInfo['Summary']['EventState'] = null;
				// $trackingInfo['Summary']['EventZIPCode'] = null;
				// $trackingInfo['Summary']['EventCountry'] = null;
				// $trackingInfo['Summary']['DeliveryAttributeCode'] = null;
			}

			if (!empty($tmpArrayData['TrackInfo']['TrackDetail'])) {
				if (!empty($tmpArrayData['TrackInfo']['TrackDetail'][0])) {
					$trackingInfo['TrackDetail'] = $tmpArrayData['TrackInfo']['TrackDetail'];
				} else {
					$trackingInfo['TrackDetail'][0] = $tmpArrayData['TrackInfo']['TrackDetail'];
				}
			} else {
				$trackingInfo['TrackDetail'] = [];
			}
		}

		return !empty($trackingInfo) ? $trackingInfo : null;
	}

	/**
	 * GET method.
	 *
	 * @param string $shipment_tracking_number FEDEX Tracking number
	 *
	 * @return array
	 */
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
		$request->getSoapClient()->__setLocation(FedexTrackServiceRequest::PRODUCTION_URL); //use production URL

		$trackReply = $request->getTrackReply($trackRequest, true);

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
	}
}
