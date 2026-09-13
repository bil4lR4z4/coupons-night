<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class Product extends Model
{
    protected $fillable = [
        'user_id',
        'store_id',
        'event_id',
        'category_id',
        'product_name',
        'product_title',
        'old_price',
        'current_price',
        'detail',
        'image',
        'url',
        'slug',
        'currency_code',
        'currency_symbol',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Admin\Category::class, 'category_id');
    }

    public function store()
    {
        return $this->belongsTo(\App\Models\Admin\Store::class, 'store_id');
    }

    public function event()
    {
        return $this->belongsTo(\App\Models\Admin\Event::class, 'event_id');
    }

    public function scopeActiveFilters($query)
    {
        return $query
            // category status
            ->where(function ($q) {
                $q->whereNull('category_id')
                ->orWhereHas('category', function ($q) {
                    $q->where('status', 'enable');
                });
            })

            // store + store categories check
            ->where(function ($q) {
                $q->whereNull('store_id')
                ->orWhereHas('store', function ($store) {
                    $store->where('status', 'enable')
                            ->whereRaw("
                                EXISTS (
                                    SELECT 1 FROM categories c
                                    WHERE FIND_IN_SET(c.id, stores.category_id)
                                    AND c.status = 'enable'
                                )
                            ");
                });
            })

            // event status
            ->where(function ($q) {
                $q->whereNull('event_id')
                ->orWhereHas('event', function ($q) {
                    $q->where('status', 'enable');
                });
            });
    }


    protected static function booted()
    {
        static::deleting(function ($product) {

            // Delete image
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }

        });
    }
}
