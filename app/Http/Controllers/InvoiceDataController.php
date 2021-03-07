<?php

namespace App\Http\Controllers;

use App\Models\InvoiceData;
use Illuminate\Http\Request;

class InvoiceDataController extends Controller
{

    function sendInvoice(Request  $request){
        $data = $request->all();

        $file_name = time().'_'.$request->banner_file->getClientOriginalName();
        $file_path = $request->file('banner_file')->storeAs('uploads', $file_name, 'public');

        $banner_public_url= public_path('storage').'/'.$file_path;

        $type = pathinfo($banner_public_url, PATHINFO_EXTENSION);
        $imgData = file_get_contents($banner_public_url);
        $banner_public_url = 'data:image/' . $type . ';base64,' . base64_encode($imgData);



        $InvoiceData=new InvoiceData();
        $InvoiceData->sender=$data['sender'];
        $InvoiceData->receiver=$data['receiver'];
        $InvoiceData->banner_url=$file_path;
        $InvoiceData->save();

        \Illuminate\Support\Facades\Mail::to($request->input('receiver'))->send(new \App\Mail\InvoiceSend($request,$banner_public_url));

    }
    //
}
