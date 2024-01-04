<?php

namespace App\Http\Controllers;
use App\Models\SuccessfullSms;
use App\Models\UnSuccessfullSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
Use Alert;
use NumberFormatter;

class CsvMessagesController extends Controller
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
        //
        return view('messages.csv_upload');
    }

    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv',
    ]);


    $uploadedFile = $request->file('csv_file');
    $senderId = auth()->user()->senderId;
    

    // Check if a file was uploaded
    if ($uploadedFile) {
        $path = $uploadedFile->getRealPath();

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($path));
        $smsCount = count($csvData) - 1; // Exclude header row

        // Process each row in the CSV
        foreach ($csvData as $index => $row) {


            // Skip header row
            if ($index === 0) {
                continue;
            }

            $number = $row[0]; // Assuming the phone number is in the first column
            $message = $row[1]; // Assuming the message is in the second column
            

           // Check if the SMS balance is less than the message request and terminate the request
           if(auth()->user()->wallet->balance  == 0) {
            toast('You have Insufficient SMS Balance to send Message to ' .$number. ' Please recharge','warning');
            return redirect()->back();   
        } 

        
           // Send SMS for each row
            $url = env('BULK_SMS_BASE_URI') . '/api/v2.1/action/send/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($number) . '/senderId/' . urlencode($senderId) . '/message/' . urlencode($message);
            $response = Http::get($url);

            $data = $response->collect();
            if ($response->status() == 202) {
                auth()->user()->wallet->withdraw(1, ['description' => 'Sending of SMS(s) via CSV Upload']);
                SuccessfullSms::create([
                    'message' => $message,
                    'responseText' => $data['responseText'],
                    'contact' => $number,
                    'status' => $response->status(),
                    'user_id' => auth()->user()->id,
                ]);

        
            } else {
                UnSuccessfullSms::create([
                    'message' => $message,
                    'responseText' => $data['responseText'],
                    'contact' => $number,
                    'status' => $response->status(),
                    'user_id' => auth()->user()->id,
                ]);
                toast('Message(s) not sent!','warning');
                return redirect()->back(); 
    
            }
        }
        toast('Message(s) sent successfully!','success');
        return redirect()->back();          
    }
    toast('No CSV file uploaded!','warning');
    return redirect()->back();  
    
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
