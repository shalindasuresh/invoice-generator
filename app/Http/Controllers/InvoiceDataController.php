<?php

namespace App\Http\Controllers;

use App\Models\InvoiceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDataController extends Controller
{

    function sendInvoice(Request  $request){

        $image = $request->banner_file;  // your base64 encoded
        $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $file_name = '/banners/'.time().'.'.$extension;

        if (preg_match('/^data:image\/(\w+);base64,/', $image)) {

            $imageData = substr($image, strpos($image, ',') + 1);

            $imageData = base64_decode($imageData);
            Storage::disk('local')->put($file_name, $imageData);
        }

        $data = $request->all();

        $banner_public_url='/home/zeroskil/services/storage/app'.$file_name;


        $InvoiceData=new InvoiceData();
        $InvoiceData->sender=$data['sender'];
        $InvoiceData->receiver=$data['receiver'];
        $InvoiceData->banner_url=$file_name;
        $InvoiceData->save();

        \Illuminate\Support\Facades\Mail::to($request->input('receiver'))->send(new \App\Mail\InvoiceSend($request,$banner_public_url));

    }
}
