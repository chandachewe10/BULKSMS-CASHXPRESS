<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $sms_balance = env('BULK_SMS_BASE_URI') . '/api/sms/balance?key=' . urlencode(env('BULK_SMS_TOKEN'));

        $response = Http::get($sms_balance);
        
        $data = $response->json(); 

        // Check if the response has the expected structure
        if (isset($data['success']) && $data['success'] === true && isset($data['responseObject'])) {
            $responseObject = $data['responseObject'];
        
            // Extract sms_balance and account_name
            $sms_balance = $responseObject['sms_balance'] ?? null;
            $account_name = $responseObject['account_name'] ?? null;
        

        } 
        
        return view('dashboard',[
            'sms_balance' => $sms_balance,
            'account_name' => $account_name
        ]);
    }
}
