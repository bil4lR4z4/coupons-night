<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use App\Models\Admin\Category;
use App\Models\Admin\Store;
class ExclusiveController extends Controller
{
    public function exclusive($slug = null)
    {
        $coupons = Coupon::with(['store', 'category'])
        ->where('is_exclusive', 1)
        ->activeFilters();
        if ($slug) {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $coupons->whereHas('store', function ($q) use ($category) {
                    $q->whereRaw("FIND_IN_SET(?, category_id)", [$category->id]);
                });
            }
        }

        $coupons = $coupons
        ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
        ->orderBy('rank', 'asc')
        ->latest()
        ->paginate(25);

        $categories = Category::where('status', 'enable')
            ->whereRaw("
                EXISTS (
                    SELECT 1 
                    FROM stores s
                    WHERE FIND_IN_SET(categories.id, s.category_id)
                    AND s.status = 'enable'
                    AND EXISTS (
                        SELECT 1 
                        FROM coupons c
                        WHERE c.store_id = s.id
                        AND c.status = 'enable'
                        AND c.is_exclusive = 1
                    )
                )
            ")
            ->latest()
            ->limit(6)
            ->get();

        $activeDeals = $coupons->count();
        $topStores = $coupons->pluck('store_id')->unique()->count();
        $verifiedCodes = $coupons->where('is_verified', 1)->count();

        return view('exclusive-discount', compact(
            'coupons',
            'categories',
            'activeDeals',
            'topStores',
            'verifiedCodes',
            'slug'
        ));
    }
}