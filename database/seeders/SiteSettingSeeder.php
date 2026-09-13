<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Header
            'header_bg_type' => 'gradient',
            'header_solid_color' => '#C0392B',
            'header_gradient_color_1' => '#8B2500',
            'header_gradient_color_2' => '#E8735A',
            'header_gradient_direction' => '90deg',
            'header_text_color' => '#FFFFFF',

            // Button
            'button_bg_type' => 'gradient',
            'button_solid_color' => '#C0392B',
            'button_gradient_color_1' => '#A93226',
            'button_gradient_color_2' => '#E74C3C',
            'button_gradient_direction' => '90deg',
            'button_text_color' => '#FFFFFF',

            // Footer
            'footer_bg_type' => 'gradient',
            'footer_solid_color' => '#212529',
            'footer_gradient_color_1' => '#111111',
            'footer_gradient_color_2' => '#333333',
            'footer_gradient_direction' => '90deg',
            'footer_text_color' => '#FFFFFF',

            // Links / Hover
            'link_color' => '#C0392B',
            'link_hover_color' => '#8E2B20',
            'text_hover_color' => '#C0392B',
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}