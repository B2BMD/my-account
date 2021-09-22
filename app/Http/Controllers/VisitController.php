<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\CurlRequest;
use Hamcrest\Arrays\IsArray;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class VisitController extends Controller
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

    public function visits(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;
        $yearArray = [];
        $monthArray = [];
        $weekArray = [];
        $curlData = CurlRequest::getDataThroughCurl('GET', env('DOWNLOAD_CONSULTANT') . "?type=get_patient_info&email=" . $email, []);
        if (empty($curlData['response'])) {
            $curlresponse = [];
        } else {
            $curlresponse = $curlData['response'];
            if (!is_array($curlresponse)) {
                $curlresponse = [];
            }
            if(isset($curlresponse[0]->message)){
                $curlresponse=[];
            }
            if (!empty($curlresponse) && is_array($curlresponse) ) {
                foreach ($curlresponse as $res) {
                    if(isset($res->message) != "no data found"){
                        $year = date('Y', strtotime($res->created_at));
                        $month = date('m', strtotime($res->created_at));
                        $week = date('W', strtotime($res->created_at));
                        if ($year <= (now()->year)) {
                            $yearArray[] = $res;
                        } else if ($month == now()->month && $year == now()->year) {
                            $monthArray[] = $res;
                        } else if ($week == now()->week && $month == now()->month && $year == now()->year) {
                            $weekArray[] = $res;
                        }
                    }
                }
            }
        }
        return view('visits.my_visits')->with(['yearArray' => $yearArray, 'monthArray' => $monthArray, 'weekArray' => $weekArray, 'userdata' => $curlresponse]);
    }
    public function upload_visits_image(Request $request)
    {
        $imageExtension = $request->visits_image->extension();
        $extensionArray = ["jpeg", "jpg", "png"];
        if (!in_array($imageExtension, $extensionArray)) {
            $data = [
                'status' => 3,
                'message'=>'Uploading file extension is invalid'
            ];
            return json_encode($data);
        }
        $user_id = Auth::user()->id;
        $image_name = time() . '_' . str_replace(' ', '_', Auth::user()->name) . '.' . $request->visits_image->extension();
        $uploadResponse = $request->visits_image->move(public_path('assets/images/visits_images/' . $user_id), $image_name);
        $filename = pathinfo($uploadResponse, PATHINFO_FILENAME);
        $imagePath = env('APP_URL') . "/assets/images/visits_images/" . $user_id . "/" . $filename . "." . $imageExtension;
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=edit_faceshot', ['casenum' => $request->case_num, 'image' => $imagePath]);
        $data1 = json_decode($curlData, true);
        if (!empty($data1['case_id'])) {
            $data = [
                'status' => 1,
                'data' => $data1,
                'imagePath' => $imagePath
            ];
            return json_encode($data);
        } else {
            $data = [
                'status' => 0,
                'message'=>'Something went wrong'
            ];
            return json_encode($data);
        }
    }
    public function upload_photo_id_image(Request $request)
    {
        $imageExtension = $request->photoId_image->extension();
        $extensionArray = ["jpeg", "jpg", "png"];
        if (!in_array($imageExtension, $extensionArray)) {
            $data = [
                'status' => 3,
                'message'=>'Uploading file extension is invalid'
            ];
            return json_encode($data);
           
          
        }
        $user_id = Auth::user()->id;
        $image_name = time() . '_' . str_replace(' ', '_', Auth::user()->name) . '.' . $request->photoId_image->extension();
      
        $uploadResponse = $request->photoId_image->move(public_path('assets/images/photoId_images/' . $user_id), $image_name);
        $filename = pathinfo($uploadResponse, PATHINFO_FILENAME);
        $imagePath = env('APP_URL') . "/assets/images/photoId_images/" . $user_id . "/" . $filename . "." . $imageExtension;
      
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=edit_photoid', ['casenum' => $request->case_num1, 'image' => $imagePath]);
        $data1 = json_decode($curlData, true);
        
        if (!empty($data1['case_id'])) {
            $data = [
                'status' => 1,
                'data' => $data1,
                'imagePath' => $imagePath
            ];
            return json_encode($data);
        } else {
            $data = [
                'status' => 0,
                'message'=>'Something went wrong'
            ];
            return json_encode($data);
        }
    }
    public function upload_areaOfConcern_image(Request $request)
    {
        $imageExtension = $request->areaOfConcern_image->extension();
        $extensionArray = ["jpeg", "jpg", "png"];
        if (!in_array($imageExtension, $extensionArray)) {
            $data = [
                'status' => 3,
                'message'=>'Uploading file extension is invalid'
            ];
            return json_encode($data);
        }
        $user_id = Auth::user()->id;
        $image_name = time() . '_' . str_replace(' ', '_', Auth::user()->name) . '.' . $request->areaOfConcern_image->extension();
        $uploadResponse = $request->areaOfConcern_image->move(public_path('assets/images/areaOfConcern_images/' . $user_id), $image_name);
        $filename = pathinfo($uploadResponse, PATHINFO_FILENAME);
        $imagePath = env('APP_URL') . "/assets/images/areaOfConcern_images/" . $user_id . "/" . $filename . "." . $imageExtension;
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=edit_areaofconcern', ['casenum' => $request->case_num2, 'image' => $imagePath]);
        $data1 = json_decode($curlData, true);
        if (!empty($data1['case_id'])) {
            $data = [
                'status' => 1,
                'data' => $data1,
                'imagePath' => $imagePath
            ];
            return json_encode($data);
        } else {
            $data = [
                'status' => 0,
                'message'=>'Something went wrong'
            ];
            return json_encode($data);
        }
     
    }
    public function refillMedicalChange(Request $request){
       if(!empty($request->caseNumber) ){
        $curlData = CurlRequest::sendPostData(env("API_URL") . '?fn=refill', ['casenum' => $request->caseNumber, 'medical_change' => '']);
        // dd($curlData);
        return $curlData;
        }else{
            return 0;
        }
    }
}
