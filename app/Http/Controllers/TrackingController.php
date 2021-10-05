<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Tracking;
use Carbon\Carbon;
use GuzzleHttp\Client;

class TrackingController extends BaseController
{
	public function history($shipment_tracking_number = null, $case_number = null)
	{
		if (is_null($shipment_tracking_number) || is_null($case_number)) {
			return ['success' => false, 'message' => 'Is Missing Tracking Number or Case Number?'];
		}

		$tracking =
			Tracking::where(['case_number' => $case_number, 'shipment_tracking_number' => $shipment_tracking_number])
				->get();

		if (is_null($tracking) || empty($tracking->first()) || ($tracking->first()->updated_at->lt(Carbon::now()->subMinutes(5)))) {
			$history = $this->callApiTrackingHistory($shipment_tracking_number);

			if (!empty($history) && !empty($history['TrackID'])) {
				if (is_object($tracking->first()) && !empty($tracking->first()->tracking_history)) {
					$old_history = json_decode($tracking->first()->tracking_history, true);
				} else {
					$old_history = '';
				}
				$shipment_provider = (empty($history['Courier']) ? 'UNKNOWN' : $history['Courier']);

				if ($old_history != $history) {
					Tracking::updateOrCreate(
						[
							'case_number' => $case_number,
							'shipment_provider' => $shipment_provider,
							'shipment_tracking_number' => $shipment_tracking_number,
						],
						[
							'tracking_history' => json_encode($history),
						]
					);
				}

				return ['tracking_history' => $history, 'message' => 'Tracking fetched from ' . $shipment_provider . '\'s API'];
			}

			return ['error' => true, 'tracking_history' => $history];
		}

		return ['tracking_history' => json_decode($tracking->first()->tracking_history, true), 'message' => 'Tracking fetched from cache.'];
	}

	private function callApiTrackingHistory($shipment_tracking_number)
	{
		$client = new Client(['base_uri' => env('B2BMD_API_URL')]);
		$token = env('B2BMD_API_KEY');
		$api_path = env('B2BMD_API_TRACKING_PATH') . '?fn=get_tracking_history&tracking_number=' . $shipment_tracking_number;

		try {
			$result =
				$client->request(
					'GET',
					$api_path,
					['headers' => ['Authorization' => "Bearer {$token}"],
					]
				)->getBody()->getContents();
			$result = @json_decode($result, true);

			if (empty($result) || empty($result['data'])) {
				$result = ['success' => false, 'error' => 'Null value returned!'];
			} else {
				$result = $result['data'];
			}
		} catch (\Throwable $e) {
			$result = ['success' => false, 'error' => $e->getMessage()];
		}

		return $result;
	}
}
