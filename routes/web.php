<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\MessagesUsageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\newsLetterSubscriptionController;
use App\Http\Controllers\RegisteredUsersController;
use App\Http\Controllers\CsvMessagesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\BulkSMSSendingController;
use App\Http\Controllers\PaymentsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


## Landing Page

Route::get('/', function () {
    return view('auth.login');
});









Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');



    ## CSV Messages Upload Controller
    Route::resource('csv', CsvMessagesController::class);

    ## Sending Bulk Messages to different Contacts
    Route::resource('bulk-sms-sending', BulkSMSSendingController::class);


    ## CSV Contacts Upload Controller
    Route::resource('csv-contacts', ContactsController::class);

    ## Retrieve all contacts via AJAX 
    Route::get('/contacts-all', [ContactsController::class, 'all_contacts'])
        ->name('all_contacts');

    ## Single Contact View Form
    Route::get('/single-contact', [ContactsController::class, 'single_contact_view'])
        ->name('single_contact_view');

    ## Single Contact Store
    Route::post('/single-contact-store', [ContactsController::class, 'single_contact_store'])
        ->name('single_contact_store');



    ## Message Controller

    Route::resource('message', MessagesController::class);

    ## Successfull Messages - Index
    Route::get('successfull_messages', [MessagesController::class, 'show_successfull_messages'])
        ->name('show_all_successfull_messages');

    Route::get('get_successfull_messages', [MessagesController::class, 'successfull_messages'])
        ->name('successfull_messages');


    ## Un Successfull Messages - Index
    Route::get('un_successfull_messages', [MessagesController::class, 'show_un_successfull_messages'])
        ->name('show_all_un_successfull_messages');

    Route::get('get_un_successfull_messages', [MessagesController::class, 'un_successfull_messages'])
        ->name('un_successfull_messages');



    ## Messages Usage Controller
    Route::resource('messages_usage', MessagesUsageController::class);
    Route::get('usage', [MessagesUsageController::class, 'usage'])
        ->name('usage');




    ## Registered Users Controller

    Route::resource('users', RegisteredUsersController::class);

    Route::get('registered_users', [RegisteredUsersController::class, 'registered_users'])
        ->name('registered_users');
});
