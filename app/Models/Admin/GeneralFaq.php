<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GeneralFaq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'sort_order',
        'status',
        'created_by',
        'updated_by',
    ];

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
}