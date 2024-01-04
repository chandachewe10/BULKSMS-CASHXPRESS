<?php

namespace App\Http\Controllers;
use MannikJ\Laravel\Wallet\Models\Wallet;
use MannikJ\Laravel\Wallet\Models\Transaction;
use App\Models\User;
use DataTables;
Use Alert;
use Illuminate\Http\Request;

class RegisteredUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return view('registered_users.index');
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
        //
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
        return view('registered_users.edit',[
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->update($request->all());
        // Update Units
        $user->wallet->deposit($request->units, ['description' => 'Deposit of SMS Units']);

        toast('User Updated Successfully!','success');
        return redirect()->back();   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function registered_users(){
        $data = User::get();
        return Datatables::of($data)
            ->addIndexColumn()  
            ->addColumn('name', function($data){
               return $data->name;
           })  
            ->addColumn('email', function($data){
                return $data->email;
            })   
            ->addColumn('senderId', function($data){
               return $data->senderId;
            })  
                    
           ->addColumn('created_at', function($data){
               return date('j, F Y',strtotime($data->created_at));
           }) 
           
           
           ->addColumn('action', function ($data) {
             $btn = "<a href='" . route('users.edit', ['user' => $data->id]) . "'><i class='fas fa-pencil text-dark'></i></a>";
           
        
            
              
          
        
            $btn .= "</div>";
        
            return $btn;
           
           })


            ->rawColumns(['name','email','senderId','created_at','action'])
            ->make(true);
    }
}
