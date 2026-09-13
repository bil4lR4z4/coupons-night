<?php

namespace App\Mail;

use App\Models\Admin\SubmittedOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmittedOfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;

    public function __construct(SubmittedOffer $offer)
    {
        $this->offer = $offer;
    }

    public function build()
    {
        return $this->subject('New Coupon Submitted')
            ->view('emails.submitted-offer');
    }
}