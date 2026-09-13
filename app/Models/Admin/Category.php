<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'description',
        'image',
        'parent_id',
        'status',
        'mark_home',
        'is_sensitive',
        'hidden_user_ids',
        'created_by',
        'updated_by',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function blogPosts()
    {
        return $this->belongsToMany(\App\Models\Admin\BlogPost::class, 'blog_post_category');
    }

    public function blogPostCat()
    {
        return $this->belongsToMany(
            \App\Models\Admin\BlogPost::class,
            'blog_post_category',
            'category_id',
            'blog_post_id'
        );
    }
    public function getHiddenUserIdsArrayAttribute()
    {
        if (!$this->hidden_user_ids) {
            return [];
        }

        return array_filter(explode(',', $this->hidden_user_ids));
    }

    public function stores()
    {
        return $this->hasMany(\App\Models\Admin\Store::class, 'category_id');
    }

    public function coupons()
{
    return $this->hasMany(\App\Models\Admin\Coupon::class, 'category_id');
}

public function products()
{
    return $this->hasMany(\App\Models\Product::class, 'category_id');
}

    // protected static function booted()
    // {
    //     static::deleting(function ($category) {

    //         // Delete category image
    //         if ($category->image && File::exists(public_path('uploads/categories/' . $category->image))) {
    //             File::delete(public_path('uploads/categories/' . $category->image));
    //         }

    //         // Delete category coupons
    //         $category->coupons()->each(function ($coupon) {
    //             $coupon->delete();
    //         });

    //         // Delete category products
    //         $category->products()->each(function ($product) {
    //             $product->delete();
    //         });

    //         // Delete category stores
    //         $category->stores()->each(function ($store) {
    //             $store->delete();
    //         });

    //     });
    // }
        
}