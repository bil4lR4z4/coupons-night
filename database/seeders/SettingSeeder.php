<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::insert([
            [
                'id' => 1,
                'site_logo' => 'uploads/site/1778865095_coupon_night_logo.png',
                'footer_logo' => 'uploads/site/1778865500_coupon_night_logo.png',
                'favicone' => 'uploads/site/1778865095_coupon_night_favicon.png',
                'site_description' => 'Your destination for verified coupons, exclusive offers, and online deals updated daily. Save smarter with every purchase.',
                'fb_link' => 'https://www.facebook.com',
                'insta_link' => 'https://www.instagram.com',
                'pinterest_link' => 'https://www.pinterest.com',
                'x_link' => 'https://www.x.com',
                'youtube_link' => 'https://www.youtube.com',
                'how_to_use' => 'Discover how to use coupons effectively, apply promo codes correctly, and avoid common checkout issues. Explore helpful guides, savings tips, and answers to frequently asked questions through our searchable help center.',
                'why_chose' => 'Coupon Night is built for shoppers who want a smarter and easier way to save online. Instead of searching through multiple websites for working coupon codes, discounts, deals, and special offers, users can discover everything in one place. From everyday shopping to seasonal sales, our platform helps people find valuable savings opportunities from popular online stores, including Amazon and many other leading brands.\r\n\r\nWe focus on creating a clean and reliable experience where shoppers can quickly browse trending offers, explore verified coupons, and discover new deals across different categories. Whether someone is shopping for fashion, electronics, beauty products, home essentials, or lifestyle items, Coupon Night helps make online shopping more rewarding by bringing together useful discounts and trusted savings in a simple and convenient way.',
                'how_to_use_image' => 'uploads/site/1778432568_347325_tiny.mp4',
                'why_chose_us_image' => 'uploads/site/1779620544_ChatGPT Image May 24, 2026, 04_01_30 PM.png',
                'offer_description' => 'Get exclusive offers, coupons, and discounts on your favorite products and services. Shop with confidence and save on your purchases today!',
                'offer_button' => 'https://couponnight.com/category',
                'offer_checkbox' => 'inactive',
                'admin_email' => 'eH5Gt@example.com',
                'created_at' => '2026-05-17 17:57:09',
                'updated_at' => '2026-05-31 20:42:05',
            ],
        ]);
    }
}