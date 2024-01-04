<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SuccessfullSms;
use App\Models\UnSuccessfullSms;
use App\Models\User;
use DataTables;
Use Alert;
use Illuminate\Support\Facades\Http;

class MessagesAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       
        
                       
             $contacts = $request->numbers;  
             $senderId = $request->sender_id;   
             $message = $request->message;
             $user = User::where('senderId',"=",$senderId)->first();
             $numbersArray = explode(',', $request->numbers); // Convert comma-separated string to an array
             $count = count($numbersArray);
             
             // Check if the SMS balance is less than the message request and terminate the request
             if($user->wallet->balance  < $count) {
                $difference = ($count) - ($user->wallet->balance); 
                return response()->json(['success'=>'false','message' => 'Insufficient SMS Balance of: '.$difference. ' to send all the message(s)'], 422);
            } 



              $url = env('BULK_SMS_BASE_URI') . '/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($contacts) . '/senderId/' . urlencode($senderId) . '/message/' . urlencode($message);
              $response = Http::get($url);

             $data = $response->collect();   
             if ($response->status() == 202)  {
              
                $user->wallet->withdraw(count(explode(',',$request->numbers)),['description' => 'Sending of SMS(s) via APIs']);
                SuccessfullSms::create([
                    'message' => $message,
                    'responseText' => $data['responseText'],
                    'contact' => $contacts,
                    'status' => $response->status(),
                    'user_id' => $user->id,
                    ]);



                return response()->json(['success'=>'true','message' => $data['responseText']], 202);
             } 
             
             else  {
                UnSuccessfullSms::create([
                    'message' => $message,
                    'responseText' => $data['responseText'],
                    'contact' => $contacts,
                    'status' => $response->status(),
                    'user_id' => $user->id,
                    ]);

                    
                return response()->json(['success'=>'false','message' => $data['responseText']], 422);
             } 


                         
                         
             
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
