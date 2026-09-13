<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_logo',
        'footer_logo',
        'favicone',
        'site_description',
        'fb_link',
        'insta_link',
        'pinterest_link',
        'x_link',
        'youtube_link',
        'how_to_use',
        'why_chose',
        'how_to_use_image',
        'why_chose_us_image',
        'offer_description',
        'offer_button',
        'offer_checkbox',
        'admin_email',
    ];
}
