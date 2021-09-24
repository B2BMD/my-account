<?php

namespace App\Helpers;

/**
 * Curl Request is used to send all the curl Requests.
 * However, the TrackingController is available in the same App,
 * we may access the controller method from this Helper avoiding overwhelm the network traffic unnecessarily.
 */
class TrackingHelper
{
    public static function trackPackage($shipment_provider, $shipment_tracking_number, $case_number)
    {
        return app('App\Http\Controllers\API\TrackingController')->history($shipment_provider, $shipment_tracking_number, $case_number);
    }
}
