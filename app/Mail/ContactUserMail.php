<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Mail\Mailable;

class ContactUserMail extends Mailable
{
    public $messageData;

    public function __construct(Message $messageData)
    {
        $this->messageData = $messageData;
    }

    public function build()
    {
        return $this->subject('Thank You For Contacting Us')
            ->view('emails.contact-user');
    }
}