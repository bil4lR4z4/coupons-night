<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubmittedOffer extends Model
{
    protected $fillable = [
        'store_url',
        'coupon_code',
        'description',
        'expiry_date',
        'first_name',
        'last_name',
        'email',
    ];

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}