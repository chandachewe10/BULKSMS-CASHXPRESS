<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SuccessfullSms;
use App\Models\UnSuccessfullSms;
use DataTables;
Use Alert;
use Illuminate\Support\Facades\Http;

class MessagesController extends Controller
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
       
       if($request->user()->tokenCan('send_messages')){
        $request->validate([
            'numbers' => 'required|array',
            'message' => 'required|string|max:160'
                    ]);
                    
                       
             $contacts = implode(',', $request->numbers);  
             $senderId = auth()->user()->senderId;   
             $message = $request->message;

            // This will be useful when you want to schedule texts at later time
            // $cat_time = Carbon::now()->addHours(2); 
            // $scheduled_time = date('Y-m-d H:i', strtotime($cat_time->addMinutes(1)));

            // Check if the SMS balance is less than the message request and terminate the request
            if(auth()->user()->wallet->balance  < count($request->numbers)) {
                $difference = (count($request->numbers)) - (auth()->user()->wallet->balance); 
                toast('You have Insufficient SMS Balance to send ' .$difference. ' number of Message(s)','warning');
                return redirect()->back();   
            } 


            $url = env('BULK_SMS_BASE_URI') . '/api/v2.1/action/send/api_key/' . urlencode(env('BULK_SMS_TOKEN')) . '/contacts/' . urlencode($contacts) . '/senderId/' . urlencode($senderId) . '/message/' . urlencode($message);

            
            $response = Http::get($url);
            
            
            
             $data = $response->collect();   
             if ($response->status() == 202)  {
                
                auth()->user()->wallet->withdraw(count($request->numbers),['description' => 'Sending of SMS(s)']);

                SuccessfullSms::create([
                'message' => $message,
                'responseText' => $data['responseText'],
                'contact' => $contacts,
                'status' => $response->status(),
                'user_id' => auth()->user()->id,
                ]);

                toast('Message(s) Sent Successfully!','success');
                return redirect()->back();   
             } 
             
             elseif ($response->status() == 422)  {
                UnSuccessfullSms::create([
                'message' => $message,
                'responseText' => $data['responseText'],
                'contact' => $contacts,
                'status' => $response->status(),
                'user_id' => auth()->user()->id,
                ]);

             toast('Message(s) Not sent!','warning');
             return redirect()->back();   
             } 


             else{
                UnSuccessfullSms::create([
                    'message' => $message,
                    'responseText' => $data['responseText'],
                    'contact' => $contacts,
                    'status' => $response->status(),
                    'user_id' => auth()->user()->id,
                    ]); 

             toast('Message(s) Not sent!','warning');
             return redirect()->back();   
             }
       }


       else{
        toast('Insufficient Units!','warning');
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

public function show_successfull_messages(){
    return view('messages.successfull_messages');
}


public function show_un_successfull_messages(){
    return view('messages.un_successfull_messages');
}



public function successfull_messages(){
    $data = SuccessfullSms::where('user_id',"=",auth()->user()->id)->get();
    return Datatables::of($data)
        ->addIndexColumn()  
        ->addColumn('message', function($data){
           return $data->message;
       })  
        ->addColumn('status', function($data){
           if($data->status == 202){
               return "SUCCESS";
           }
           else
         {
               return "UNSUCCESSFULL";    
           }
        })   
        
        
        ->addColumn('contact', function($data){
           return $data->contact;
        })  
        ->addColumn('responseText', function($data){
           return $data->responseText;
       }) 
       
       ->addColumn('created_at', function($data){
           return date('j, F Y',strtotime($data->created_at));
       })  
       
        
      
        ->rawColumns(['message','status','contact','responseText','created_at'])
        ->make(true);
}



public function un_successfull_messages(){
    $data = UnSuccessfullSms::where('user_id',"=",auth()->user()->id)->get();
    return Datatables::of($data)
        ->addIndexColumn()  
        ->addColumn('message', function($data){
           return $data->message;
       })  
        ->addColumn('status', function($data){
           if($data->status == 422){
               return "UNSUCCESSFULL";
           }
           else
         {
               return "SUCCESSFULL";    
           }
        })   
        
        
        ->addColumn('contact', function($data){
           return $data->contact;
        })  
        ->addColumn('responseText', function($data){
           return $data->responseText;
       }) 
       
       ->addColumn('created_at', function($data){
           return date('j, F Y',strtotime($data->created_at));
       })  
       
        
      
        ->rawColumns(['message','status','contact','responseText','created_at'])
        ->make(true);
}



}
