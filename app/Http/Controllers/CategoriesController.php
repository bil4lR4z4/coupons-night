<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Store;
use App\Models\Admin\Event;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class CategoriesController extends Controller
{
// public function frontend()
// {
//     $categories = Category::whereNull('parent_id')
//         ->where('status', 'enable')
//         ->with('children')
//         ->get();

//     return view('category', compact('categories'));
// }

public function frontend(Request $request)
{
    $categories = Category::whereNull('parent_id')
        ->where('status', 'enable')

        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })

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

        ->with('children')
        ->paginate(50)
        ->withQueryString();

    return view('category', compact('categories'));
}
    public function couponCategory($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 'enable')
            ->firstOrFail();

        $categoryIds = collect([$category->id]);

        $childIds = Category::where('parent_id', $category->id)
            ->where('status', 'enable')
            ->pluck('id');

        $categoryIds = $categoryIds->merge($childIds);

        // $coupons = Coupon::with(['store', 'category'])
        //     ->activeFilters()
        //     ->whereIn('category_id', $categoryIds)
        //     ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
        //     ->orderBy('rank', 'asc')
        //     ->orderBy('sort_order', 'asc')
        //     ->get();

        $coupons = Coupon::with('store')
            ->where('status', 'enable')
            ->whereHas('store', function ($query) use ($category) {

                $query->where('status', 'enable')
                    ->whereRaw("FIND_IN_SET(?, category_id)", [$category->id]);

            })
            ->orderByRaw('CASE WHEN rank IS NULL THEN 1 ELSE 0 END')
            ->orderBy('rank', 'asc')
            ->orderBy('sort_order', 'asc')
            ->paginate(25);

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
            ->when($category, function ($query) use ($category) {
                $query->whereRaw("FIND_IN_SET(?, category_id)", [$category->id]);
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
                ->latest()
                ->limit(4)
                ->get();
        }

        return view('coupon-categories', compact(
            'category',
            'coupons',
            'brands',
            'popularCategories',
            'relatedStores'
        ));
    }  
}