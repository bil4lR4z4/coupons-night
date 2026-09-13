<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\UserLog;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $edit = Setting::first();
        return view('admin.settings.index', compact('edit'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'site_logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'footer_logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicone'      => 'nullable|image|mimes:ico,png,jpg|max:1024',

            'site_description' => 'nullable|string',

            'fb_link'       => 'nullable|url',
            'insta_link'    => 'nullable|url',
            'pinterest_link'=> 'nullable|url',
            'x_link'        => 'nullable|url',
            'youtube_link'  => 'nullable|url',
            'admin_email' => 'nullable|email',
        ]);

        $setting = Setting::first();

        $data = $request->only([
            'site_description',
            'fb_link',
            'insta_link',
            'pinterest_link',
            'x_link',
            'youtube_link',
            'admin_email',
        ]);

        foreach (['site_logo', 'footer_logo', 'favicone'] as $image) {
            if ($request->hasFile($image)) {
                if ($setting && $setting->$image && file_exists(public_path($setting->$image))) {
                    unlink(public_path($setting->$image));
                }

                $file = $request->file($image);
                $filename = time().'_'.$file->getClientOriginalName();

                $file->move(public_path('uploads/site'), $filename);

                $data[$image] = 'uploads/site/'.$filename;
            }
        }

        Setting::updateOrCreate(
            ['id' => 1],
            $data
        );

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update',
            'detail'  => "Settings updated successfully",
        ]);

        return back()->with('success', 'Settings saved successfully');
    }

    public function homePage(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'how_to_use' => 'nullable|string',
                'why_chose'  => 'nullable|string',
                'how_to_use_image' => 'nullable|mimes:mp4,mov,avi,webm,mkv|max:20480',
                'why_chose_us_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $setting = Setting::first();

            $data = $request->only([
                'how_to_use',
                'why_chose',
            ]);

            foreach (['how_to_use_image', 'why_chose_us_image'] as $image) {
                if ($request->hasFile($image)) {
                    if ($setting && $setting->$image && file_exists(public_path($setting->$image))) {
                        unlink(public_path($setting->$image));
                    }

                    $file = $request->file($image);
                    $filename = time().'_'.$file->getClientOriginalName();

                    $file->move(public_path('uploads/site'), $filename);

                    $data[$image] = 'uploads/site/'.$filename;
                }
            }

            Setting::updateOrCreate(
                ['id' => 1],
                $data
            );

            UserLog::create([
                'user_id' => auth()->id(),
                'action'  => 'Update',
                'detail'  => "Home page settings updated successfully",
            ]);

        }
        $edit = Setting::first();
        
        return view('admin.settings.home', compact('edit'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(20) . '.' . $extension;
            
            $file->move(public_path('uploads'), $filename);

            $url = asset('uploads/' . $filename);

            return response()->json(['fileName' => $filename, 'uploaded' => 1, 'url' => $url]);
        }
    
        return response()->json(['error' => 'File not uploaded'], 400);
    }

    public function homePagePopup(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'offer_description' => 'nullable|string',
                'offer_button' => 'nullable|string',
                'offer_checkbox' => 'nullable|string',
            ]);

            $setting = Setting::first();

            $data = $request->only([
                'offer_description',
                'offer_button',
            ]);
$data['offer_checkbox'] = $request->has('offer_checkbox') 
            ? 'active' 
            : 'inactive';
            Setting::updateOrCreate(
                ['id' => 1],
                $data
            );

            UserLog::create([
                'user_id' => auth()->id(),
                'action'  => 'Update',
                'detail'  => "Home page popup updated successfully",
            ]);

        }
        $edit = Setting::first();
        
        return view('admin.settings.home_popup', compact('edit'));
    }
}