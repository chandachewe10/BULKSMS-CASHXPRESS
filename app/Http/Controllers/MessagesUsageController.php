<?php

namespace App\Http\Controllers;

use MannikJ\Laravel\Wallet\Models\Wallet;
use MannikJ\Laravel\Wallet\Models\Transaction;
use DataTables;
use Illuminate\Http\Request;

class MessagesUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('messages.usage');
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


    public function usage(){
        $data = Transaction::where('wallet_id',"=",auth()->user()->id)->get();
        return Datatables::of($data)
            ->addIndexColumn()  
            ->addColumn('units', function($data){
               return $data->amount;
           })  
            ->addColumn('type', function($data){
                return $data->type;
            })   
            ->addColumn('description', function($data){
               return $data->meta['description'] ?? '';
            })  
                    
           ->addColumn('created_at', function($data){
               return date('j, F Y',strtotime($data->created_at));
           })  
           
            ->rawColumns(['units','type','description','created_at'])
            ->make(true);
    }
}
