<?php

namespace App\Helpers;

use SimpleXMLElement;

/**
 * Curl Request is used to send all the curl Requests
 *
 * @package    Mint
 */
class TrackingHelper
{
    public static function trackPackage()
    {
        $trackingNumber = "9400110200830344768358";
        $url = env('USPS_URL');
        $userId = env("USPS_USER_ID");
        $service = "TrackV2";
        $xml = rawurlencode("<TrackRequest USERID='".$userId."'><TrackID ID='".$trackingNumber."'></TrackID></TrackRequest>");
        $request = $url . "?API=" . $service . "&XML=" . $xml;

        // send the POST values to USPS
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$request);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // parameters to post
    
        $result = curl_exec($ch);
        curl_close($ch);
    
        $response = $result;
        $response = new SimpleXMLElement($result);
        // print_r($result);
        // $deliveryStatus = $response->TrackResponse->TrackSummary->Status;
        // echo $deliveryStatus;

        // trying to read xml
        // $xmlObject = simplexml_load_string($response);
        $json = json_encode($response);
        $phpArray = json_decode($json, true); 

        return $phpArray;
    }
}