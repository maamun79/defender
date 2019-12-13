<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MissingPersonLocation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * 
     *
     * @return void
     */
    public $sub;
    public $msg;
    public function __construct($subject, $newmsg)
    {
        $this->sub = $subject;
        $this->msg = $newmsg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_sub = $this->sub;
        $e_msg = $this->msg;
        return $this->view('emails.missingPersonLocationMail', compact("e_msg"))
                    ->subject($e_sub)
                    ->attach('img/missingPerson/'.$e_msg['person']['photo']);
    }
}
