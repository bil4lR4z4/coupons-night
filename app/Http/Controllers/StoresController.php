<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Store;
use App\Models\Admin\Category;
use App\Models\Product;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use DB;
class StoresController extends Controller
{
public function browser(Request $request) { $stores = Store::where('status', 'enable') ->when($request->search, function ($query) use ($request) { $query->where('name', 'like', '%' . $request->search . '%'); }) ->whereRaw(" EXISTS ( SELECT 1 FROM categories cat WHERE FIND_IN_SET(cat.id, stores.category_id) AND cat.status = 'enable' ) ") ->whereRaw(" EXISTS ( SELECT 1 FROM coupons c WHERE c.store_id = stores.id AND c.status = 'enable' ) ") ->orderBy('name') ->paginate(50) ->withQueryString(); return view('sitemap', compact('stores')); }
    public function show($slug)
    {
        $store = Store::with([
            'category',
            'network',
            'faqs',
            'coupons',
            
        ])
        ->where('slug', $slug)
        ->where('status', 'enable')
        ->firstOrFail();

        $coupons = Coupon::with('store')
            ->where('is_no_code', 0)
            ->where('status', 'enable')
            ->whereHas('store', function ($query) use ($slug) {
                $query->where('slug', $slug)
                    ->where('status', 'enable');
            })
            ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
            ->orderBy('rank', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();

        $deals = Coupon::with('store')
            ->where('is_no_code', 1)
            ->where('status', 'enable')
            ->whereHas('store', function ($query) use ($slug) {
                $query->where('slug', $slug)
                    ->where('status', 'enable');
            })
            ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
            ->orderBy('rank', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();

        $products = Product::activeFilters()
            ->where('store_id', $store->id)
            ->with('category')
            ->latest()
            ->take(12)
            ->get();

        $brands = Store::where('status', 'enable')
            ->whereRaw("
                EXISTS (
                    SELECT 1
                    FROM categories cat
                    WHERE FIND_IN_SET(cat.id, stores.category_id)
                    AND cat.status = 'enable'
                )
            ")
            ->whereRaw("
                EXISTS (
                    SELECT 1
                    FROM coupons c
                    WHERE c.store_id = stores.id
                    AND c.status = 'enable'
                )
            ")
            ->where('id', '!=', $store->id)
            ->inRandomOrder()
            ->limit(12)
            ->get();

        
        $popularCategories = Category::where('status', 'enable')
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
             ->inRandomOrder()
            ->limit(12)
            ->get();
        
        $relatedStores = Store::where('status', 'enable')
            ->where('id', '!=', $store->id)
            ->where(function ($query) use ($store) {

                $categories = explode(',', $store->category_id);

                foreach ($categories as $category) {
                    $query->orWhereRaw("FIND_IN_SET(?, category_id)", [trim($category)]);
                }

            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('categories')
                    ->where('categories.status', 'enable')
                    ->whereRaw("FIND_IN_SET(categories.id, stores.category_id)");
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('coupons')
                    ->whereColumn('coupons.store_id', 'stores.id')
                    ->where('coupons.status', 'enable');
            })
            ->latest()
            ->limit(4)
            ->get();

        if ($relatedStores->count() == 0) {
            $relatedStores = Store::where('status', 'enable')
                ->where('id', '!=', $store->id)
                ->latest()
                ->limit(4)
                ->get();
        }
        $productChunks = $products->chunk(4);
        $totalOffers = $store->coupons->count();
        $couponCodes = $store->coupons->where('is_no_code', '0')->count();
        $dealCodes = $store->coupons->where('is_no_code', '1')->count();
        $freeShipping = $store->coupons->where('free_shipping', 1)->count();

        return view('store', compact('store','productChunks','products','totalOffers','freeShipping','couponCodes','dealCodes','brands','popularCategories','relatedStores', 'coupons', 'deals'));
    }

    public function searchStore(Request $request)
    {
        $store = Store::where('status', 'enable')

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

            ->where(function($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $request->search . '%');
            })

            ->latest()
            ->first();

        if ($store) {
            return redirect()->route('store.show', $store->slug);
        }

        return back()->with('error', 'Store not found');
    }

    public function searchStoreAjax(Request $request)
{
    $stores = Store::where('status', 'enable')

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

        ->where(function($query) use ($request){
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('slug', 'LIKE', '%' . $request->search . '%');
        })

        ->select('name', 'slug', 'logo')

        ->latest()
        ->take(10)
        ->get();

    return response()->json($stores);
}
}