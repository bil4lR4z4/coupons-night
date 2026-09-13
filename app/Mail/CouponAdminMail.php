<?php

namespace App\Mail;

use App\Models\Admin\SubmittedOffer;
use Illuminate\Mail\Mailable;

class CouponAdminMail extends Mailable
{
    public $offer;

    public function __construct(SubmittedOffer $offer)
    {
        $this->offer = $offer;
    }

    public function build()
    {
        return $this->subject('New Coupon Submitted')
            ->view('emails.coupon-admin');
    }
}