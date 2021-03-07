<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \Illuminate\Support\Facades\App;

class InvoiceSend extends Mailable
{
    use Queueable, SerializesModels;
    private $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request=$request;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->request->all();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('templates.pdf.invoice', ['data'=>$data]);

        return $this->attachData($pdf->output(),'invoice.pdf')->view('templates.emails.invoice');
    }
}
