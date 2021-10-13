<?php

namespace App\Http\Controllers;

use App\Helpers\CurlRequest;
use Brick\Math\BigNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CURLFile;


class TestController extends Controller
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

    public function tests()
    {
        $user = Auth::user();
        $email = $user->email;
        $yearArray=[];
        $monthArray=[];
        $weekArray=[];
        $curlData = CurlRequest::getDataThroughCurl('GET', env('DOWNLOAD_CONSULTANT') . "?type=get_patient_info&email=" . $email, []);
        // dd($curlData);
        if (empty($curlData)) {
            $curlresponse = [];
            // dd($curlresponse);
        } else {
            
            $curlresponse = $curlData['response'];
            if (!is_array($curlresponse)) {
                $curlresponse = [];
            }
            if (isset($curlresponse[0]->message)) {
                $curlresponse = [];
            }
        }
        // dd($curlresponse);
        return view('tests.my_tests')->with(['userdata' => $curlresponse]);
        // return view('tests.my_tests');
    }
    public function get_tests(Request $request)
    {
        $casenum = $request->casenum;
        $id = $request->case_id;
        $email = Auth::user()->email;
        // consult api response
        // $userdata = CurlRequest::getDataThroughCurl('GET', env('DOWNLOAD_CONSULTANT') . "type=get_patient_info&email=" . $email, []);
        // dd($userdata);
        // lab report api
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=get_lab_report', ['casenum' => $casenum,'email' => $email]);
        $curlData = json_decode($curlData);

        return view('tests.my_test_report_listing')->with(['lab_reports'=>$curlData,'case_id'=>$id]);
    }
    // upload_test_report
    public function upload_test_report(Request $request){
        // dd($request->file);
        // $report_extension = $request->test_report->extension();
        // $extensionArray = ["jpeg", "jpg", "png", "pdf"];
        // if (!in_array($report_extension, $extensionArray)) {
            // return  back()->withErrors(['test_report' => ['Uploading file extension is invalid']]);
        // }

        $user_id = Auth::user()->id;
        $casenum = $request->case_num;
        $email = Auth::user()->email;
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=upload_lab_report', ['casenum' => $casenum,'email' => $email,'file' => $_FILES]);
        dd($curlData);
        $data1 = json_decode($curlData, true);
        // if (!empty($data1['case_id'])) {
        //     $data = [
        //         'status' => 1,
        //         'data' => $data1,
        //     ];
        //     $jsonData = json_encode($data);
        //     return $report_path;
        // } else {
        //     return $data1['message'];
        // }
    }

    // Testing upload file thriugh curl
    public function upload(Request $request){
        $url = "http://localhost/projects/blog/public/api/upload";
        // dd($request->file('test')->getMimeType());
        if($request->file('test')->getMimeType() !='application/pdf'){
            // return redirect()->back()->withErrors("Invalid file format");
            return "Invalid file format";
        }
        // for upload api uncomment this
        $url = env('API_URL').'?fn=upload_lab_report';
     
        $tmp_file = $_FILES['test']['tmp_name'];
        $file_name = basename($_FILES['test']['name']);
        $post_field['file'] =  curl_file_create($tmp_file, $_FILES['test']['type'], $file_name);

        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        // testing
        curl_setopt($ch, CURLOPT_POST, 1);
        // $file = new CURLFile($_FILES['file']['name']);
        // ,$_FILES['file']['type'],$_FILES['file']['name']
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $header_data= curl_getinfo($ch);
        curl_close($ch);
        dd($result);
        // dd($args['file']);
    }
}