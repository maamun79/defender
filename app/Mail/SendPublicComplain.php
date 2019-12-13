<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPublicComplain extends Mailable
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
        return $this->view('emails.publicPlaceComplainMail', compact("e_msg"))
                    ->subject($e_sub)
                    ->attach('img/publicPlaceComplain/'.$e_msg->photo)
                    ->attach('video/publicPlaceComplain/'.$e_msg->video);
    }
}
