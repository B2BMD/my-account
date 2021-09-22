<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\Otp;
use App\Models\UserAddress;
use App\Models\Usercard;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\sendOtpRequest;
use App\Http\Requests\sendLinkRequest;
use App\Http\Requests\verifyOtpRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Helpers\CurlRequest;
use Carbon\Carbon;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Contracts\Session\Session;
use phpDocumentor\Reflection\PseudoTypes\True_;

// use Illuminate\Http\Client\Request;

class UserController extends Controller
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

    // redirects to the create/signup page
    public function signup()
    {
        return view('users.create');
    }

    // redirects to the forgot_password page
    public function forgotPassword()
    {
        return view('users.forgot_password');
    }

    // registers the user to the database and make session and logs in the user
    public function register(SignupRequest $request)
    {
        if (empty($request)) {
            return (404);
        }

        $res = User::create([
            'name' => $request->sign_up_name,
            'email' => $request->sign_up_email,
            'password' => Hash::make($request->sign_up_password),
        ]);
        if ($res) {
            return 0;
        }
    }

    // validates the user in database and creates the user and redirects to VisitController/visits

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // remember me token
        $remember = $request->has('remember_me_checkbox') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return 1;
        } else {
            return 'The provided credentials do not match our records.';
        }
    }

    // redirects to the signin/login page
    public function login()
    {
        return view('users.login');
    }

    // destroys the session and redirects to the signin/login page
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->flush();
        return view('users.login_out');
    }

    // redirects the user to the profile page
    public function profile()
    {
        $address = UserAddress::where('user_id', Auth::user()->id)->first();
        $visaDetails=Usercard::where('user_id',Auth::user()->id)->get();
        // $visaDetailsLatest=Usercard::where('user_id',Auth::user()->id)->latest()->first();
        // $stripe = new \Stripe\StripeClient(
        //     env('STRIPE_SECRET_KEY')
        //    );
        //    try{
        //     $cardDetails=$stripe->customers->allSources(
        //         $visaDetailsLatest->customer_stripe_id,
        //         ['object' => 'card']
        //       );
        //    } catch (\Exception $e) {
        //     return "Something went wrong with your card";
        //     }
            // dd($cardDetails->data[0]['id']);
        
        // dd($visaDetails['card_number']);
        if ($address || $visaDetails) {
            return view('users.profile',['address'=> $address,'visaDetails'=>$visaDetails]);
        } else {
            return view('users.profile');
        }
    }
    public function updatePassword(Request $request)
    {
        $r = ResetPassword::where('hash', $request->token)->first();

        if ($r) {
            if ($r->is_expired == 1) {
                return view('users.invalidlink', ['msg' => 'Link has been expired']);
            } else {
                $updatepass = User::where('email', $r->email)->update([
                    'password' => Hash::make($request->password)
                ]);

                if ($updatepass) {
                    $r->update([
                        'is_expired' => 1
                    ]);
                    return view('users.invalidlink', ['msg' => 'Your password has been updated successfully!']);
                } else {
                    return view('users.invalidlink', ['msg' => 'Some error occured. Please try again!']);
                }
            }
        }
    }

    // updates the user profile in the database
    public function update_profile(Request $request)
    {
        $data = $request->input();
        $profile = User::find(Auth::user()->id);

        // name
        if (isset($data['name'])) {
            $profile->name = trim(preg_replace('/\s+/', ' ', $data['name']));       // to remove excess space from name
        }

        // dob
        if (isset($data['dob'])) {
            $profile->dob = $data['dob'];
        }

        // checking if the password is empty
        if (isset($data['password'])) {
            $profile->password = Hash::make($data['password']);
            $response['password'] = True;
        }

        // checking if the phone number is empty
        if (isset($data['phone_number'])) {
            $profile->phone_number = preg_replace('/\s+/', '', $data['phone_number']);     // To remove excess space between numbers
            $response['phone_number'] = True;
        }

        $response['profile'] = $profile->update();

        // Address
        if (isset($data['formatted_address'])) {
            $data['formatted_address'] = trim(preg_replace('/\s+/', ' ', $data['formatted_address']));
            $address = UserAddress::where('user_id', Auth::user()->id)->first();
            $res = UserAddress::updateOrCreate(
                ['user_id' => Auth::user()->id],
                [
                    'formatted_address' => $data['formatted_address']
                ]
            );
            if ($res) {
                $response['address'] = $data['formatted_address'];
                return $response;
            }
        }
        return json_encode($response);
    }
    public function sendEmail(sendLinkRequest $request)
    {

        $hash = bin2hex(random_bytes(16));
        $data = [
            'link' => env('APP_URL') . "/resetPassword/" . $hash
        ];
        Mail::to($request->email)->send(new \App\Mail\ResetPasswordMail($data));
        $res = ResetPassword::updateOrCreate(['email' => $request->email], [
            'hash' => $hash,
            'is_expired' => 0
        ]);
        if ($res) {
            return 1;
        } else {
            return "Something went wrong";
        }
    }
    public function emailSentConfirmation()
    {
        return view('users.email_sent_confirmation');
    }
    public function resetPassword($id)
    {
        $r = ResetPassword::where('hash', $id)->first();

        if ($r) {
            if ($r->is_expired == 1) {
                return view('users.invalidlink', ['msg' => 'Link has been expired']);
            } else {
                return view('users.password_reset', ['token' => $id]);
            }
        } else {
            return view('users.invalidlink', ['msg' => 'Invalid link']);
        }
    }

    public function upload_profile_image(Request $request)
    {
        // 
        $imageExtension = $request->profile_image->extension();
        $extensionArray = ["jpeg", "jpg", "png"];
        if (!in_array($imageExtension, $extensionArray)) {
            // dd($request->profile_image->extension());
            return  back()->withErrors(['profile_image' => ['Uploading file extension is invalid']]);
        }

        $user_id = Auth::user()->id;
        $image_name = time() . '_' . str_replace(' ', '_', Auth::user()->name) . '.' . $request->profile_image->extension();    // To remove space from image name

        // saving image path in database
        $user = User::find(Auth::user()->id);
        if ($user->image_path == NULL) {
            $user->image_path = $image_name;
            $user->save();
        } else {
            $user->image_path = $image_name;
            $response['profile_image'] = $user->update();
        }

        // Saving the image in files
        $request->profile_image->move(public_path('assets/images/profile/profile_images/' . $user_id), $image_name);
        $path = env('APP_URL') . '/assets/images/profile/profile_images/' . $user_id . '/' . $image_name;

        return json_encode($path);
    }
    public function filtered_data($type, $case_number)
    {
        $filtered_info = [
            'type' => $type,
            'case_number' => $case_number,
        ];
        return view('search.search_content')->with('filtered_info', $filtered_info);
    }
    public function getCardDetails(Request $request){
        $user = Auth::User();
        $stripe = new \Stripe\StripeClient(
           env('STRIPE_SECRET_KEY')
          );
          $visaDetailsLatest=Usercard::where('stripe_customer_id',$request->stripe_customer_id)->first();
           try{
            $cardDetails=$stripe->customers->allSources(
                $visaDetailsLatest->customer_stripe_id,
                ['object' => 'card']
              );
           } catch (\Exception $e) {
            return "Something went wrong with your card";
            }
    }
    
}
