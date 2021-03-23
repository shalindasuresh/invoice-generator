<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('layouts.vue');
})->where('any', '.*');

Route::post('/send', [\App\Http\Controllers\InvoiceDataController::class, 'sendInvoice']);


//Route::get('/email', function () {
//   return view('templates.emails.invoice', ['data'=>['receiver' => 'shalinda1990@gmail.com','sender' => 'aravinda0@gmail.com']]);
//});


Route::get('/pdf', function () {
   return view('templates.pdf.invoice',
       ['data'=>['receiver' => 'shalinda1990@gmail.com','sender' => 'aravinda0@gmail.com',
       'banner_url'=>'https://s1.logaster.com/static/v3/img/products/logo.png',
       'items'=>'{}',
       'date'=>200,
       'due_date'=>200,
       'balance'=>200,
       'total'=>200,
       'amount_paid'=>100,
       'notes'=>"Hello this is my note",
       'terms'=>"Hello this is terms and conditions",
       ]]);
});
