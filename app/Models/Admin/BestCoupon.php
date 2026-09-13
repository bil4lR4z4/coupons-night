<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class BestCoupon extends Model
{
    protected $fillable = [
        'store_id',
        'title',
        'html_link',
        'image',
        'created_by',
        'updated_by',
    ];

    public function store()
    {
        return $this->belongsTo(\App\Models\Admin\Store::class, 'store_id');
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function scopeActiveStore($query)
    {
        return $query->whereHas('store', function ($store) {
            $store->where('status', 'enable')
                ->whereRaw("
                    EXISTS (
                        SELECT 1 FROM categories c
                        WHERE FIND_IN_SET(c.id, stores.category_id)
                        AND c.status = 'enable'
                    )
                ");
        });
    }

    protected static function booted()
    {
        static::deleting(function ($bestCoupon) {

            // Delete image
            if ($bestCoupon->image && File::exists(public_path('uploads/best-coupons/' . $bestCoupon->image))) {
                File::delete(public_path('uploads/best-coupons/' . $bestCoupon->image));
            }

        });
    }

}