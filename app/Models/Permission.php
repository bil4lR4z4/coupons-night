<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'coupon',
        'category',
        'network',
        'store',
        'product',
        'blog',
        'event',
        'store_general_faqs',
        'best_coupon',
        'message',
        'user',
        'user_activity',
        'submitted_offer',
        'theme_setting',
        'site_setting',
        'home_setting',
        'term',
        'help',
        'affiliate',
        'disclaimer',
        'privacy',
        'faqs',
        'marque',
        'upcoming_event',
        'geo_restriction',
        'store_approval',
        'store_report'
    ];
}
