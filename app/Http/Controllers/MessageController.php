<?php

namespace App\Http\Controllers;

use App\Helpers\CurlRequest;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function messages()
    {
        $user = Auth::User();
        $email = $user->email;
        $curlData = CurlRequest::getDataThroughCurl('GET', env('DOWNLOAD_CONSULTANT') . "?type=get_patient_info&email=" . $email, []);
        $curlresponse = $curlData['response'];
        if (!isset($curlresponse) || !is_array($curlresponse) || isset($curlresponse[0]->message)) {
            $curlresponse = [];
        }
        return view('messages.messages')->with('userdata', $curlresponse);
    }

    public function get_messages(Request $request)
    {
        $casenum = $request->casenum;
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=get_messages', ['casenum' => $casenum]);
        return $curlData;
    }

    public function send_message(Request $request)
    {
        // dd($request->all());
        $curlData = CurlRequest::sendPostData(env("API_URL") . "?fn=send_message", [
            'casenum' => $request->casenum,
            'message' => $request->message,
        ]);
        // dd(json_decode($curlData)->message_id);
            if(!empty(json_decode($curlData)->message_id)){
                $curlRes=json_decode($curlData);
                $data=[
                    'status'=>1,
                    'message_id'=>$curlRes->message_id
                ];
                return json_encode($data);
            }else if(!empty(json_decode($curlData)->code)){
                $curlRes=json_decode($curlData);
                $data=[
                    'status'=>2,
                    'code'=> $curlRes->code,
                    'message'=>$curlRes->message
                ];
                return json_encode($data);

            }
            else{
                $data=[
                    'status'=>0,
                    'message'=>'Something went wrong'
                ];
                return json_encode($data);
            }
    }
}
