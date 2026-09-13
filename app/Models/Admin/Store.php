<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Models\Admin\Category;
class Store extends Model
{
    protected $fillable = [
    'name',
    'slug',
    'secondary_name',
    'heading_h1',
    'heading_h2',
    'domain',
    'about',
    'store_url',
    'impression_code',
    'html_code',
    'description',
    'store_title',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'network_id',
    'category_id',
    'logo',
    'thumbnail_image',
    'is_popular',
    'is_featured',
    'is_category_featured',
    'is_trending',
    'is_top',
    'status',
    'replace_store_id', 
    'created_by',
    'updated_by',
    'website',
    'email',
    'phone_no',
    'address',
    'facebook_url',
    'youtube_url',
    'google_plus_url',
    'twitter_url',
    'pinterest_url',
    'wikipedia_url',
    'products_name',
    'shipping',
    'iphone_app',
    'android_app',
    'payment_methods',
    'embed_code',
    'coupon_check',
    'approval_status',
];

    public function network()
    {
        return $this->belongsTo(\App\Models\Admin\Network::class, 'network_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Admin\Category::class, 'category_id');
    }

    public function categories()
{
    return Category::whereIn('id',explode(',', $this->category_id));
}
    public function faqs()
    {
        return $this->hasMany(\App\Models\Admin\StoreFaq::class, 'store_id')->orderBy('sort_order');
    }

    public function replaceStore()
     {
         return $this->belongsTo(\App\Models\Admin\Store::class, 'replace_store_id');
     }
     
     public function creator()
     {
         return $this->belongsTo(\App\Models\User::class, 'created_by');
     }
     
     public function updater()
     {
         return $this->belongsTo(\App\Models\User::class, 'updated_by');
     }

    public function coupons()
    {
        return $this->hasMany(\App\Models\Admin\Coupon::class, 'store_id');
    }


public function bestCoupons()
{
    return $this->hasMany(\App\Models\Admin\BestCoupon::class, 'store_id');
}
public function products()
{
    return $this->hasMany(\App\Models\Product::class, 'store_id');
}

protected static function booted()
{
    static::deleting(function ($store) {
        if ($store->logo && File::exists(public_path('uploads/stores/' . $store->logo))) {
            File::delete(public_path('uploads/stores/' . $store->logo));
        }
        if ($store->thumbnail_image && File::exists(public_path('uploads/stores/' . $store->thumbnail_image))) {
            File::delete(public_path('uploads/stores/' . $store->thumbnail_image));
        }
        $store->coupons()->each(function ($coupon) {
            $coupon->delete();
        });

        $store->products()->each(function ($product) {
            $product->delete();
        });
         $store->bestCoupons()->each(function ($bestCoupon) {
         $bestCoupon->delete();
        });
        $store->faqs()->delete();

    });
}

}