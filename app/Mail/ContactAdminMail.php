<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Mail\Mailable;

class ContactAdminMail extends Mailable
{
    public $messageData;

    public function __construct(Message $messageData)
    {
        $this->messageData = $messageData;
    }

    public function build()
    {
        return $this->subject('New Contact Message Received')
            ->view('emails.contact-admin');
    }
}