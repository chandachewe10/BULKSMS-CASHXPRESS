<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Alert;
use App\Imports\ContactsImport;
use DataTables;
use Illuminate\Validation\ValidationException;
class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contacts.csv_upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Excel::import(new ContactsImport, request()->file('csv_file'));
            toast('Contact(s) added successfully', 'success');
        } catch (ValidationException $e) {
            // Handle validation errors
            $errors = $e->validator->errors();
            foreach ($errors->all() as $error) {
                toast($error, 'warning');
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            toast($e->getMessage(), 'error');
        }
        
        return redirect()->back();
    }
        
           
    

    /**
     * Display the specified resource.
     */
    public function show(string $csv_contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $csv_contact)
    {
       
        return view('contacts.edit',[
            'contact' => \App\Models\contacts::find($csv_contact)
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $csv_contact)
    {
       
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' =>      'nullable|email',
            'phone' =>       ['required','regex:/^(09|07)[5|6|7][0-9]{7}$/'],
            'address' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255'
        ]);

        $contact = \App\Models\contacts::findOrFail($csv_contact);
        $contact->update($request->all());

     toast($request->input('first_name').'s Contact Details updated successfully!','success');
     return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $csv_contact)
    {
        $user = \App\Models\contacts::find($csv_contact);
        $user->delete();
        toast('User has been trashed  successfully!','success');
        return redirect()->back();
    }



    public function all_contacts(){
    
        // if ($request->ajax()) {
            
             $data = \App\Models\contacts::where('user_id',"=",auth()->user()->id)->get();
             return Datatables::of($data)
                 ->addIndexColumn()  
                 ->addColumn('first_name', function($data){
                     return $data->first_name;
                 })   
                 ->addColumn('last_name', function($data){
                     return $data->last_name;
                 })   
                 ->addColumn('phone', function($data){
                    
                     return $data->phone;
                 })   
                 ->addColumn('email', function($data){
                    return $data->email;
                 })  
                
     
               ->addColumn('address', function($data){
                     return $data->address;
                 })  
                 ->addColumn('company', function($data){
                     return $data->company;
                 })  
                 ->addColumn('nationality', function($data){
                     return $data->nationality;
                 })  
                 
                 ->addColumn('tag', function($data){
                    return $data->tag;
                })  
                
                 ->addColumn('created_at', function($data){
                     return date('d,F-Y',strtotime($data->created_at));
                 })  
                 
                 ->addColumn('action', function ($data) {
                       $btn = "<div class='table-actions'>

                       <a href='" . route('csv-contacts.edit', ['csv_contact' => $data->id]) . "'><i class='fas fa-pencil text-dark'></i></a>";
                 
                        
                    
                                
                         $btn .= "<a data-bs-toggle='modal' data-bs-target='#delete-modal' href='" . route('csv-contacts.destroy', ['csv_contact' => $data->id]) . "' class='delete-link'>&#x1F5D1;</a>";
                    
                         
                         $btn .= "</div>";
                 
                         return $btn;
                 
             }) 
                 
                 ->rawColumns(['first_name','last_name','mannumber','phone','email','address','company','nationality','tag','created_at','action'])
                 ->make(true);
         
     
     
     }


      /**
     * Display a 'form for single contact.
     */
    public function single_contact_view()
    {
       
        return view('contacts.single_contact');
    }






         /**
     * Add Single Contact in Storage.
     */
    public function single_contact_store(Request $request)
    {
       
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' =>      'nullable|email|unique:contacts',
            'phone' =>       ['required','regex:/^(09|07)[5|6|7][0-9]{7}$/','unique:contacts'],
            'address' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'tag' => 'required|string|max:255'
        ]);

        \App\Models\contacts::create($request->all());
        

     toast($request->input('first_name').'s Contact Details added successfully!','success');
     return redirect()->back();
    }
}
