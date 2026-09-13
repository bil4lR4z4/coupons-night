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

    public function search(Request $request)
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

       
        return view('search', compact('store'));
    }

    public function ajax(Request $request)
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