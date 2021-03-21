<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentInvoice extends Mailable
{
    use Queueable, SerializesModels;
    protected $dynamic_data="";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($val)
    {
        $this->dynamic_data = $val;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invoice',[
            'data' => $this->dynamic_data
        ]);
    }
}
