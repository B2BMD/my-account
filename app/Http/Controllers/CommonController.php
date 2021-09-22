<?php

namespace App\Http\Controllers;

use App\Helpers\CurlRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Usercard;
use App\Exceptions\StripeSomeThingWentWrong;

class CommonController extends Controller
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

    public function contact_us()
    {
        return view('others.contact_us');
    }

    public function faq()
    {
        return view('others.faq');
    }

    // public function schedule()
    // {
    //     return view('others.schedule_call_2');
    // }

    public function schedule()
    {
        $user = Auth::User();
        $email = $user->email;
        $curlData = CurlRequest::getDataThroughCurl('GET', env('DOWNLOAD_CONSULTANT') . "?type=get_patient_info&email=" . $email, []);
        $curlresponse = $curlData['response'];
        if (isset($curlresponse[0]->message)) {
            $curlresponse = [];
        }

        // dd($curlresponse);
        return view('others.schedule_call')->with('userdata', $curlresponse);
    }
    // public function schedule_call()
    // {
    //     return view('others.schedule_call');
    // }
    public function contactMail(Request $request){
        $data=[
            'email'=>$request['contactEmail'],
            'name'=>$request['contactName'],
            'message'=>$request['contactMessage']


        ];
        Mail::to(env('CONTACT_MAIL'))->send(new \App\Mail\ContactUsMail($data));
        return 1;
    }
    public function paymentForm(){
        dd("Fgd");
        return view('others.payment');
    }
    public function checkoutPayment(Request $request){
        $user = Auth::User();
        $stripe = new \Stripe\StripeClient(
           env('STRIPE_SECRET_KEY')
          );
          try{
            $tokenResponse= $stripe->tokens->create([
                'card' => [
                    'number' => $request->cardnumber,
                    'exp_month' => $request->expmonth,
                    'exp_year' => $request->expyear,
                    'cvc' => $request->cvv,
                ],
                ]);
            }
            catch (\Exception $e) {
                // throw new StripeSomeThingWentWrong(trans($e->getMessage()));
                return "Something went wrong while creating token";
            }
          try{
            $stripeCustomerDetails= $stripe->customers->create([
                'description' => $user->name . '(' . $user->email . ')',
                'source'=>$tokenResponse->id
              ]);
              $customerId=$stripeCustomerDetails->id;
              if(!empty($customerId)){
                $user->stripe_customer_id = $customerId;
                $res=Usercard::create([
                                'user_id'=>$user->id,
                                'card_number'=>substr($request->cardnumber, -4),
                                'card_type'=>$tokenResponse->card->brand,
                                'customer_stripe_id'=>$customerId
                            ]);
                            if(empty($res)){
                                return 0;
                            }
                $user->save();
                return $res;
              }else{
                  return 0;
              }
             
            
            } catch (\Exception $e) {
                // throw new StripeSomeThingWentWrong(trans($e->getMessage()));
                return "Something went while creating customer";
            }
          
            // dd($tokenResponse->card->brand);
            // dd(substr($request->cardnumber, -4));
          
            // if(!empty($stripeCustomerDetails)){
            //   $customerId=$stripeCustomerDetails->id;
            //   if(!empty($tokenResponse)){
            //     try {
            //         $card = $stripe->customers->createSource(
            //             $customerId,
            //             ['source' => $tokenResponse->id]
            //         );
            //         $user->stripe_customer_id = $customerId;
            //         $res=Usercard::create([
            //             'user_id'=>$user->id,
            //             'card_number'=>$card->last4,
            //             'card_type'=>$tokenResponse->card->brand,
            //             'customer_stripe_id'=>$customerId
            //         ]);
            //         if(empty($res)){
            //             return 0;
            //         }
            //         $user->save();
            //         return 1;
            //     } catch (\Exception $e) {
            //         // throw new StripeSomeThingWentWrong(trans($e->getMessage()));
            //         return "Something went wrong while saving the card";
            //     }
            //   }else{
            //       return 0;
            //   }
            // }else{
            //     return 0;
            // }
        
    }
  
}
