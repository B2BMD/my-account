<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\UploadTestReportController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Routes protected by the middleware


Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/visits');
    } else {
        return view('users.login');
    }
});
Route::get('/login', function () {
    if (Auth::user()) {
        return redirect('/visits');
    } else {
        return view('users.login');
    }
})->name('login');

Route::get('/signup', [UserController::class, 'signup']);
Route::get('/forgot_password', [UserController::class, 'forgotPassword']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/signin', [UserController::class, 'signin']);
Route::post('/sendEmail', [UserController::class, 'sendEmail']);
Route::get('/send_link', [UserController::class, 'emailSentConfirmation']);
Route::post('/verify_otp', [UserController::class, 'verifyOtp']);
Route::post('/update_password', [UserController::class, 'updatePassword']);


Route::get('/resetPassword/{id}', [UserController::class, 'resetPassword']);
Route::post('/reset', [UserController::class, 'successupdatepass']);




Route::group(['middleware' => 'auth'], function () {
    // Route::get('/login', [VisitController::class,'visits']);


    // Global search of doctors
    Route::get('/filter/{type}/{case_number}', [UserController::class, 'filtered_data']);

    //UserController and users view
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::view('/payment','others.payment');
    Route::post('/checkout', [CommonController::class, 'checkoutPayment']);
    Route::get('/getCardDetails', [UserController::class, 'getCardDetails']);




    // update the user image
    Route::post('/upload_profile_image', [UserController::class, 'upload_profile_image']);
    Route::post('/upload_visits_image', [VisitController::class, 'upload_visits_image']);
    Route::post('/upload_photo_id_image', [VisitController::class, 'upload_photo_id_image']);
    Route::post('/upload_areaOfConcern_image', [VisitController::class, 'upload_areaOfConcern_image']);
    Route::post('/refill', [VisitController::class, 'refillMedicalChange']);





    // testing the updation in database
    Route::post('/update', [UserController::class, 'update_profile']);

    //MessageController and messages view
    Route::get('/messages', [MessageController::class, 'messages']);
    Route::post('/get_messages', [MessageController::class, 'get_messages']);
    Route::post('/send_message', [MessageController::class, 'send_message']);
    Route::post('/contact_us', [CommonController::class, 'contactMail']);


    //OrderController and orders view
    Route::get('/orders', [OrderController::class, 'orders']);
    Route::get('/completed_orders', [OrderController::class, 'completed_orders']);
    Route::get('/all_orders/{slug}', [OrderController::class, 'pending_orders'])->name('all_orders');
    Route::get('/orders_details', [OrderController::class, 'getOrders']);
    Route::get('/product_details', [OrderController::class, 'getProducts']);
    Route::get('/single_order', [OrderController::class, 'singleOrder']);
    Route::get('/view_order/{order_id}', [OrderController::class, 'viewOrderDetails'])->name('view_order');
    Route::get('/track_order/{order_id}', [OrderController::class, 'trackOrder']);


    // trial route for usps tracking
    Route::get('/track', [OrderController::class, 'track_package']);


    //UploadTestReportController and tests view
    Route::get('/tests', [UploadTestReportController::class, 'tests']);
    Route::post('/get_tests', [UploadTestReportController::class, 'get_tests']);
    Route::post('/upload_test_report', [UploadTestReportController::class, 'upload']);
    
    //CommonController and others view
    // Route::get('/schedule_call', [CommonController::class, 'schedule_call']);
    Route::get('/schedule', [CommonController::class, 'schedule']);
    Route::get('/faq', [CommonController::class, 'faq']);
    Route::get('/contact_us', [CommonController::class, 'contact_us']);

    //VisitController and visits view
    Route::get('/visits', [VisitController::class, 'visits']);
});
