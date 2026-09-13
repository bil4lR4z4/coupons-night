<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GeoRestrictionSetting;
use App\Models\UserLog;

class GeoRestrictionController extends Controller
{

public function index()
{
    $setting = GeoRestrictionSetting::first();
    $blocked = $setting ? $setting->blocked_countries : [];

    $response = Http::timeout(10)
        ->get('https://countriesnow.space/api/v0.1/countries/iso');

    if (!$response->successful()) {
        dd('API failed', $response->status(), $response->body());
    }

    $data = $response->json()['data'] ?? [];

    $countries = collect($data)
        ->map(function ($country) {
            return [
                'name' => $country['name'],
                'code' => $country['Iso2'],
            ];
        })
        ->filter(fn($c) => $c['name'] && $c['code'])
        ->sortBy('name')
        ->values();

    return view('admin.geo.index', compact('blocked', 'countries'));
}

    public function store(Request $request)
{
    $setting = GeoRestrictionSetting::first() ?? new GeoRestrictionSetting();

    $setting->blocked_countries = $request->blocked_countries ?? [];
    $setting->save();

    UserLog::create([
        'user_id' => auth()->id(),
        'action'  => 'Update Geo Restriction',
        'detail'  => "Geo Restriction updated successfully",
    ]);
    return back()->with('success', 'Settings updated');
}
}