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

Route::post('/send2', function (Request $request) {

    \Illuminate\Support\Facades\Mail::to($request->input('receiver'))->send(new \App\Mail\InvoiceSend($request));
});

Route::post('/send', [\App\Http\Controllers\InvoiceDataController::class, 'sendInvoice']);

/*
Route::get('/now', function () {
//    return $pdf->stream();
    \Illuminate\Support\Facades\Mail::to('shalinda1990@gmail.com')->send(new \App\Mail\InvoiceSend());
});
*/
