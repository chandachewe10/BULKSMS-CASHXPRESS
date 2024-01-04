<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessfullSms;
use App\Models\UnSuccessfullSms;
use Alert;
use Illuminate\Support\Facades\Http;

class BulkSMSSendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('messages.bulk-sms-sending');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'dataField' => 'required',
            'message' => 'required|string|max:160'
        ]);

        $contacts = implode(', ', $request->dataField);

        $senderId = auth()->user()->senderId;
        $message = $request->message;

        // This will be useful when you want to schedule texts at later time
        // $cat_time = Carbon::now()->addHours(2); 
        // $scheduled_time = date('Y-m-d H:i', strtotime($cat_time->addMinutes(1)));

        // Check if the SMS balance is less than the message request and terminate the request
        if (auth()->user()->wallet->balance < count($request->dataField)) {
            $difference = (count($request->dataField)) - (auth()->user()->wallet->balance);
            toast('You have Insufficient SMS Balance to send ' . $difference . ' number of Message(s)', 'warning');
            return redirect()->back();
        }


        $url = env('BULK_SMS_BASE_URI') . '/api/v2.1/action/send/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($contacts) . '/senderId/' . urlencode($senderId) . '/message/' . urlencode($message);

        $response = Http::get($url);



        $data = $response->collect();
        if ($response->status() == 202) {

            auth()->user()->wallet->withdraw(count($request->dataField), ['description' => 'Sending of SMS(s)']);

            SuccessfullSms::create([
                'message' => $message,
                'responseText' => $data['responseText'],
                'contact' => $contacts,
                'status' => $response->status(),
                'user_id' => auth()->user()->id,
            ]);

            toast('Message(s) Sent Successfully!', 'success');
            return redirect()->back();
        } elseif ($response->status() == 422) {
            UnSuccessfullSms::create([
                'message' => $message,
                'responseText' => $data['responseText'],
                'contact' => $contacts,
                'status' => $response->status(),
                'user_id' => auth()->user()->id,
            ]);

            toast('Message(s) Not sent!', 'warning');
            return redirect()->back();
        } else {
            UnSuccessfullSms::create([
                'message' => $message,
                'responseText' => $data['responseText'],
                'contact' => $contacts,
                'status' => $response->status(),
                'user_id' => auth()->user()->id,
            ]);

            toast('Message(s) Not sent!', 'warning');
            return redirect()->back();
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