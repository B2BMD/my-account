<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ImageController extends Controller
{
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
	}

	public function get_image($folder = null, $case_number = null, $image_file = null)
	{
		if (!is_null($folder) && !is_null($case_number) && !is_null($image_file)) {
			$client = new Client(['base_uri' => env('X_PARTNERS_IMAGE_API_URL')]);
			$token = env('X_PARTNERS_IMAGE__KEY');
			$api_path = '?file_name=/case_images/' . $folder . '/' . $case_number . '/' . $image_file;

			try {
				$result =
					$client->request(
						'GET',
						$api_path,
						['headers' => ['X-API-KEY' => "{$token}"],
							'Accept' => 'application/json',
						]
					)->getBody()->getContents();

				$result = @json_decode($result, true);

				if (empty($result) || empty($result['file'])) {
					return false;
				}
				header('Content-type: image/png');
				echo base64_decode($result['file']);

				exit;
			} catch (\Throwable $e) {
				return $e->getMessage();
			}
		}

		return false;
	}
}
