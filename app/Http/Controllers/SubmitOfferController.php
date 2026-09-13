<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Admin\SubmittedOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use App\Mail\CouponAdminMail;
use App\Mail\CouponUserMail;
class SubmitOfferController extends Controller
{
    public function index()
    {
        return view('submit-offer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_url'    => 'required|url|max:255',
            'coupon_code'  => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'expiry_date'  => 'nullable|date',
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'nullable|string|max:100',
            'email'        => 'required|email|max:255',
        ]);

        $offer = SubmittedOffer::create($request->only([
            'store_url',
            'coupon_code',
            'description',
            'expiry_date',
            'first_name',
            'last_name',
            'email',
        ]));

        $admins = User::where('role', 'admin')
            ->whereNotNull('email')
            ->pluck('email')
            ->toArray();

        $setting = Setting::first();
Mail::to($setting->admin_email)
    ->send(new CouponAdminMail($offer));

Mail::to($request->email)
    ->send(new CouponUserMail($offer));
        return redirect()
            ->back()
            ->with('success', 'Your coupon has been submitted successfully.');
    }
}