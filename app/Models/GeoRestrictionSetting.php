<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoRestrictionSetting extends Model
{
    protected $table = 'geo_restriction_settings';

    protected $fillable = [
        'blocked_countries'
    ];

    protected $casts = [
        'blocked_countries' => 'array',
    ];
}