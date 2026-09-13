<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CouponVote extends Model
{
    protected $fillable = [
        'coupon_id',
        'likes',
        'dislikes',
    ];

    public function coupon()
    {
        return $this->belongsTo(\App\Models\Admin\Coupon::class, 'coupon_id');
    }
}