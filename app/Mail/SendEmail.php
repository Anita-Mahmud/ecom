<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $custom_message="";



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
       $this->custom_message = $message;



    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('offer')->view('email.sendemail',[
            'custom_message' => $this->custom_message,

        ]);
    }
}
