<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class StoreFaq extends Model
{
    protected $fillable = [
        'store_id',
        'question',
        'answer',
        'sort_order',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(\App\Models\Admin\Store::class, 'store_id');
    }
}