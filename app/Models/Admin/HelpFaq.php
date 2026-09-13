<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HelpFaq extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];
}