<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AffiliateSection extends Model
{
    protected $table = 'affiliate_sections';

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];
}