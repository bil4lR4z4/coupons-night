<?php

use App\Models\Admin\SiteSetting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return SiteSetting::where('key', $key)->value('value') ?? $default;
    }
}