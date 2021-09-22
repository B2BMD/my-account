<?php
namespace App\Helpers;

use Facade\Ignition\SolutionProviders\RunningLaravelDuskInProductionProvider;

/**
 * Curl Request is used to send all the curl Requests
 *
 * @package    Mint
 */
class CurlRequest
{
    public static function getDataThroughCurl($method, $url, $requestData , $headerToken = "")
    {
        $response = [];
        
        if (!in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
            throw new \Exception('Only supports GET/POST/PUT/PATCH/DELETE methods');
        }

        $curlHeadervalues =  array(
            // Set here required headers
            "accept: */*",
            "accept-language: en-US,en;q=0.8",
            "content-type: application/json",
            "Authorization:Bearer ".$headerToken
        );

        $curl = curl_init();

        $curlparam = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $curlHeadervalues,
            
        );

        if($method != 'GET'){
            $curlparam[CURLOPT_POST] = count($requestData);
            $curlparam[CURLOPT_POSTFIELDS] = json_encode($requestData);
        }
        curl_setopt_array($curl, $curlparam);
        $responseText = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);
   
        if ($err) {
            $response['error'] = 1;
            $response['response'] = $err;
        } else {
            $response['response'] = json_decode($responseText);
        }

        return $response;
    }
    public static function sendPostData($url, $requestData , $headerToken = "")
    {
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($requestData));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $header_data= curl_getinfo($ch);
        curl_close($ch);
        // dd($result);
        if ($err) {
            $response['error'] = 1;
            $response['response'] = $err;
        } else {
            $response['response'] = json_decode($result);
            return $result;
        }        
    }
}
