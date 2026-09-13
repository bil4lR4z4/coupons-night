<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'meta_description',
        'full_description',
        'icon',
        'full_image',
        'image_square',
        'show_in_header',
        'status',
    ];


public function coupons()
{
    return $this->hasMany(\App\Models\Admin\Coupon::class, 'event_id');
}
public function products()
{
    return $this->hasMany(\App\Models\Product::class, 'event_id');
}
protected static function booted()
{
    static::deleting(function ($event) {

        // Delete icon
        if ($event->icon && File::exists(public_path('uploads/events/' . $event->icon))) {
            File::delete(public_path('uploads/events/' . $event->icon));
        }

        // Delete full image
        if ($event->full_image && File::exists(public_path('uploads/events/' . $event->full_image))) {
            File::delete(public_path('uploads/events/' . $event->full_image));
        }

        // Delete square image
        if ($event->image_square && File::exists(public_path('uploads/events/' . $event->image_square))) {
            File::delete(public_path('uploads/events/' . $event->image_square));
        }

        // Delete coupons
        $event->coupons()->each(function ($coupon) {
            $coupon->delete();
        });

        $event->products()->each(function ($product) {
    $product->delete();
});

    });
}
}