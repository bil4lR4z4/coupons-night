<?php

namespace App\Mail;

use App\Models\Admin\SubmittedOffer;
use Illuminate\Mail\Mailable;

class CouponUserMail extends Mailable
{
    public $offer;

    public function __construct(SubmittedOffer $offer)
    {
        $this->offer = $offer;
    }

    public function build()
    {
        return $this->subject('Thank You For Submitting Your Coupon')
            ->view('emails.coupon-user');
    }
}