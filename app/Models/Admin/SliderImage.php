<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
        'type',
        'page_url',
        'title',
        'image',
        'sort_order',
        'status',
        'button_text',
    ];
}