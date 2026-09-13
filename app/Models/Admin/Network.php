<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'status',
    ];

        public function stores()
    {
        return $this->hasMany(Store::class, 'network_id');
    }

}