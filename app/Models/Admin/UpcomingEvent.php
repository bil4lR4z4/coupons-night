<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UpcomingEvent extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'start_date',
        'end_date',
        'button_text',
        'button_link',
        'badge_text',
        'background_color',
        'button_color',
        'image',
        'status',
    ];
}