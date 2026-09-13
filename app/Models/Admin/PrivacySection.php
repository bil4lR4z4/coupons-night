<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PrivacySection extends Model
{
    protected $table = 'privacy_sections';

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];
}