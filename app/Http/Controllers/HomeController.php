<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\FaqItem;
use App\Models\Admin\Store;
use App\Models\Admin\Coupon;
use App\Models\Product;
use App\Models\Admin\BestCoupon;
use App\Models\Admin\SliderImage;
use App\Models\Admin\UpcomingEvent;
use App\Models\Setting;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $faqs = FaqItem::where('status', 'enable')->orderBy('sort_order', 'asc')->get();

        $featuredStores = Store::where('status', 'enable')
            ->where('is_featured', 1)
            ->whereRaw("
                EXISTS (
                    SELECT 1 
                    FROM categories cat
                    WHERE FIND_IN_SET(cat.id, stores.category_id)
                    AND cat.status = 'enable'
                    
                    AND EXISTS (
                        SELECT 1 
                        FROM coupons c
                        WHERE c.store_id = stores.id
                        AND c.status = 'enable'
                    )
                )
            ")
            ->latest()
            ->limit(25)
            ->get();

        if ($featuredStores->count() < 25) {

            $remaining = 25 - $featuredStores->count();

            $otherStores = Store::where('status', 'enable')
                ->where('is_featured', '!=', 1)
                ->whereNotIn('id', $featuredStores->pluck('id'))
                ->whereRaw("
                    EXISTS (
                        SELECT 1 
                        FROM categories cat
                        WHERE FIND_IN_SET(cat.id, stores.category_id)
                        AND cat.status = 'enable'
                        
                        AND EXISTS (
                            SELECT 1 
                            FROM coupons c
                            WHERE c.store_id = stores.id
                            AND c.status = 'enable'
                        )
                    )
                ")
                ->latest()
                ->limit($remaining)
                ->get();

            $stores = $featuredStores->merge($otherStores);

        } else {
            $stores = $featuredStores;
        }

        $products = Product::with(['category', 'store','event'])
            ->activeFilters()
            ->latest()
            ->take(12)
            ->get();

        $coupons = Coupon::with(['category', 'store', 'event'])
            ->where('is_no_code', 0)
            ->activeFilters()
            ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
            ->orderBy('rank', 'asc')
            ->orderBy('sort_order', 'asc')
            ->take(4)
            ->get();

        $bestCoupons = BestCoupon::with('store')
            ->activeStore()
            ->latest()
            ->take(12)
            ->get();

        $carousels = SliderImage::where('type', 'slider')->where('status', 'enable')->orderBy('sort_order')->get();

        $settings = Setting::first();

        $deals = Coupon::where('is_no_code', 1)
    ->where('is_verified', 1)
    ->where('is_homepage', 1)
    ->activeFilters()
    ->orderBy('created_at', 'desc') // latest first
    ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
    ->orderBy('sort_order', 'asc')
    ->with('store')
    ->limit(5)
    ->get();

        $popularStores = Store::where('is_popular', 1)
            ->where('status', 'enable')
            
            ->whereHas('coupons', function ($q) {
                $q->where('status', 'enable');
            })
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('categories')
                    ->where('categories.status', 'enable')
                    ->whereRaw('FIND_IN_SET(categories.id, stores.category_id)');
            })
            ->get();

        $featuredCategories = Category::where('status', 'enable')
            ->where('mark_home', 1)
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
                    )
                )
            ")
            ->latest()
            ->limit(12)
            ->get();

        if ($featuredCategories->count() < 12) {
            $remaining = 12 - $featuredCategories->count();
            $otherCategories = Category::where('status', 'enable')
                ->where('mark_home', '!=', 1)
                ->whereNotIn('id', $featuredCategories->pluck('id'))
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
                        )
                    )
                ")
                ->latest()
                ->limit($remaining)
                ->get();

            $categories = $featuredCategories->merge($otherCategories);

        } else {
            $categories = $featuredCategories;
        }

        $upcomingEvent = UpcomingEvent::where('status', 1)->whereDate('start_date', '>=', now())->orderBy('start_date')->first();
    //    dd($upcomingEvent);
        return view('welcome', compact('faqs','products','coupons','bestCoupons', 'carousels', 'settings','deals', 'popularStores', 'stores','categories','upcomingEvent'));
    }
    
    public function coupons(Request $request) { 
        $coupons = Coupon::with(['category', 'store']) 
                    ->activeFilters() 
                    ->when($request->filled('search'), 
                    function ($query) use ($request) { 
                        $query->whereHas('store', 
                        function ($storeQuery) use ($request) { 
                            $storeQuery->where( 'name', 'like', '%' . $request->search . '%' ); 
                        }); 
                    }) 
                    ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END') 
                    ->orderBy('rank', 'asc') 
                    ->orderBy('sort_order', 'asc') 
                    ->paginate(50) 
                    ->withQueryString(); 
        return view('coupons', compact('coupons')); 
    }
}