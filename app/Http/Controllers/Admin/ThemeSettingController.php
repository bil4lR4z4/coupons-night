<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting;
use Illuminate\Http\Request;
use App\Models\UserLog;

class ThemeSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        return view('admin.theme-settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'header_bg_type' => 'required|in:solid,gradient',
            'header_solid_color' => 'nullable|string|max:30',
            'header_gradient_color_1' => 'nullable|string|max:30',
            'header_gradient_color_2' => 'nullable|string|max:30',
            'header_gradient_direction' => 'nullable|string|max:20',
            'header_text_color' => 'nullable|string|max:30',

            'button_bg_type' => 'required|in:solid,gradient',
            'button_solid_color' => 'nullable|string|max:30',
            'button_gradient_color_1' => 'nullable|string|max:30',
            'button_gradient_color_2' => 'nullable|string|max:30',
            'button_gradient_direction' => 'nullable|string|max:20',
            'button_text_color' => 'nullable|string|max:30',

            'footer_bg_type' => 'required|in:solid,gradient',
            'footer_solid_color' => 'nullable|string|max:30',
            'footer_gradient_color_1' => 'nullable|string|max:30',
            'footer_gradient_color_2' => 'nullable|string|max:30',
            'footer_gradient_direction' => 'nullable|string|max:20',
            'footer_text_color' => 'nullable|string|max:30',

            'link_color' => 'nullable|string|max:30',
            'link_hover_color' => 'nullable|string|max:30',
            'text_hover_color' => 'nullable|string|max:30',
        ]);

        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update',
            'detail'  => "Theme settings updated successfully",
        ]);

        return back()->with('success', 'Theme settings updated successfully.');
    }
}