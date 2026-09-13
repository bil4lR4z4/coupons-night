<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class Coupon extends Model
{
    protected $fillable = [
        'store_id',
        'category_id',
        'event_id',
        'name',
        'detail',
        'coupon_code',
        'coupon_image_line_1',
        'coupon_image_line_2',
        'coupon_image_line_3',
        'html_code',
        'start_date',
        'end_date',
        'is_exclusive',
        'free_shipping',
        'is_homepage',
        'is_top_category',
        'is_special_offer',
        'is_verified',
        'is_no_code',
        'rank',
         'sort_order',
        'status',
        'date_type',
        'date_text',
        'created_by',
        'updated_by',
    ];

    public function store()
    {
        return $this->belongsTo(\App\Models\Admin\Store::class, 'store_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Admin\Category::class, 'category_id');
    }

    public function event()
    {
        return $this->belongsTo(\App\Models\Admin\Event::class, 'event_id');
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function vote()
    {
        return $this->hasOne(\App\Models\Admin\CouponVote::class, 'coupon_id');
    }

    public function scopeActiveFilters($query)
    {
        return $query
            ->where('status', 'enable')
            ->whereHas('store', function ($q) {
                $q->where('status', 'enable')
                ->whereExists(function ($sub) {
                    $sub->selectRaw(1)
                        ->from('categories')
                        ->where('categories.status', 'enable')
                        ->whereRaw('FIND_IN_SET(categories.id, stores.category_id)');
                });
            });
    }

protected static function booted()
{
    static::created(function ($coupon) {

        $store = $coupon->store;

        if (!$store) {
            return;
        }

        $couponCount = $store->coupons()->count();

        if ($couponCount >= 5) {

            $store->update([
                'coupon_check' => 1,
            ]);

        }

    });
}

}