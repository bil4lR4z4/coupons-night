<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DisclaimerSection extends Model
{
    protected $table = 'disclaimer_sections';

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];
}