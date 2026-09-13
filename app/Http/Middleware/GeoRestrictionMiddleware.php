<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GeoRestrictionSetting;
use Torann\GeoIP\Facades\GeoIP;

class GeoRestrictionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 🔹 Get settings from DB
        $setting = GeoRestrictionSetting::first();

        
        if ($setting && !empty($setting->blocked_countries)) {

            try {
                // 🌍 Detect user country
                $location = GeoIP::getLocation($request->ip());
                // dd($request->ip(), $location);
                $country = $location->iso_code ?? null;
            } 
            catch (\Exception $e) {
                      dd($e->getMessage());
             }

            // 🚫 Check if blocked
            if ($country && in_array($country, $setting->blocked_countries)) {
                return response()->view('errors.geo-blocked', [
                    'country' => $country
                ], 403);
            }
        }

        return $next($request);
    }
}