<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FaqItem extends Model
{
    protected $table = 'faq_items';

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];
}