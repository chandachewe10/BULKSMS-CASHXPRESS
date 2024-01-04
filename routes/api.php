<?php
use App\Http\Controllers\API\MessagesAPI;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Models\sparco_payments;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('receive_payload', function (Request $request) {
    // Verify Signature

    // Log the request information
    Log::info('Received payload:', ['payload' => $request->all()]);

    // Handle the received payload


// Check if call back is being sent twice
//$second_call_back_ref = sparco_payments::where('reference','=',$request->reference)->first();
$second_call_back_merc = sparco_payments::where('merchantReference','=',$request->merchantReference)->first();


if($second_call_back_merc){
    //unprocess
    abort(422);
}

else{

     // Get the payload data from the request

    $payment = new sparco_payments($request->all());
    $payment->save();

    // Update Messages 
    $customerFirstName = $request->customerFirstName;
    $transactionAmount = $request->transactionAmount;
    $customerMobileWallet = $request->customerMobileWallet;
    $isError = $request->isError;

    //Notification Message
    $message = 'Hello ' . $customerFirstName . ' ' . 'We have received a Bulk-SMS Payment of K' . $transactionAmount . '. Your BULK-SMS will be updated ASAP Automagically';
    $ourSenderId = 'MACROIT';
    // Find user who made the payments
    $user = User::where('phone', "=", $customerMobileWallet)->first();

    if (!$user) {
        abort(404);
    } else {

        if ($transactionAmount == 300 && $isError == false) {
            $user->wallet->deposit(1000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);


        } elseif ($transactionAmount == 650 && $isError == false) {
            $user->wallet->deposit(2000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);

        } elseif ($transactionAmount == 1000 && $isError == false) {
            $user->wallet->deposit(3000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);
        } elseif ($transactionAmount == 1350 && $isError == false) {
            $user->wallet->deposit(4000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);
        } elseif ($transactionAmount == 1450 && $isError == false) {
            $user->wallet->deposit(5000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);
        } elseif ($transactionAmount == 1750 && $isError == false) {
            $user->wallet->deposit(6000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);
        } elseif ($transactionAmount == 2000 && $isError == false) {
            $user->wallet->deposit(7000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);
        } elseif ($transactionAmount == 2200 && $isError == false) {
            $user->wallet->deposit(8000, ['description' => 'Deposit of SMS Units via sparco payments portal']);
            //Send Message that we have recieved the payments
            $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($customerMobileWallet) . '/senderId/' . urlencode($ourSenderId) . '/message/' . urlencode($message);
            Http::get($url);
        } else {
            Log::info('User found but transaction error occured for:', ['payload' => $request->reference]);

        }

    }
}
});



Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::get('send_message', [MessagesAPI::class, 'store']);

});