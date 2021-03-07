<?php

namespace App\Http\Controllers;

use App\Models\InvoiceData;
use Illuminate\Http\Request;

class InvoiceDataController extends Controller
{

    function sendInvoice(Request  $request){
        $data = $request->all();

        $InvoiceData=new InvoiceData();
        $InvoiceData->sender=$data['sender'];
        $InvoiceData->receiver=$data['receiver'];
        $InvoiceData->save();

        \Illuminate\Support\Facades\Mail::to($request->input('receiver'))->send(new \App\Mail\InvoiceSend($request));

    }
    //
}
