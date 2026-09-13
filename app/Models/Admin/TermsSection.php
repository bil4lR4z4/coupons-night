<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TermsSection extends Model
{
    protected $table = 'terms_sections';

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];
}