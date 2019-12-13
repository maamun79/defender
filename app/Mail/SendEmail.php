<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $sub;
     public $msg;

    public function __construct($subject, $message)
    {
        $this->sub = $subject;
        $this->msg = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build()
    {
        $e_sub = $this->sub;
        $e_msg = $this->msg[0];
        return $this->view('emails.mail', compact("e_msg"))->subject($e_sub);
    }
}
