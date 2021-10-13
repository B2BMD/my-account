<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
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
    public function signup(Request $request)
    {
      
        return view('users.create');
    }

    // registers the user to the database and make session and logs in the user
    public function register(SignupRequest $request)
    {

        User::create([
            'name' => $request->sign_up_name,
            'email' => $request->sign_up_email,
            'password' => Hash::make($request->sign_up_password),
        ]);

        $user = User::where('email', $request->input('sign_up_email'))->first();

        $request->session()->put('user', $user);
            
        if(!null == session('user'))
        {
            return redirect('/login');
        }
        else
        {
            dd(session('user'));
            return redirect('/login');
        }

    }

    // validates the user in database and creates the user and redirects to VisitController/visits

    public function signin(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email','exists:users,email'],
            'password' => ['required'],
        ]);

        $data=User::where('email',$credentials['email'])->first();
        $passwordmatch=Hash::check($credentials['password'], $data->password);
       
        // remember me token
        $remember = $request->has('remember_me_checkbox') ? true : false;
      
        if($passwordmatch == true){
            $request->session()->regenerate();
            return redirect()->intended('/visits');
        }else{
            return back()->withErrors([
                  
                    'message' => 'Please check you user email and password .',
                   
                ]);
        }
        
        
    

        // if (Auth::attempt($credentials, $remember)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('/visits');
        // }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }

    // redirects to the signin/login page
    public function login()
    { 
     
        return view('users.login');
    }

    // destroys the session and redirects to the signin/login page
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');

    }

    // redirects the user to the profile page
    public function profile()
    {
        return view('users.profile');
    }

    // updates the user profile in the database
    public function update_profile(Request $request)
    {
        $data = $request->input();
        // $user = new User;
        // $user->name = $data['name'];
        $profile = User::find(Auth::user()->id);

        $profile->name = $data['name'];
        $profile->dob = $data['dob'];
        $profile->email = $data['email'];
        $profile->phone_number = $data['phone'];

        $response['profile'] = $profile->update();
        // Address
        $address = UserAddress::find(Auth::user()->id);
        $address->formatted_address = $data['formatted_address'];

        $response['address'] = $address->update();
        // DB::table('users')->where('id'= Auth::user()->id)->update($user);
        return json_encode($response);
    }
}