<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Coupon;
use App\Models\Product;
use App\Models\Admin\Store;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    public function activityReport(Request $request)
    {
        $from = $request->from_date
            ? date('Y-m-d 00:00:00', strtotime($request->from_date))
            : now()->startOfDay();

        $to = $request->to_date
            ? date('Y-m-d 23:59:59', strtotime($request->to_date))
            : now()->endOfDay();

        $users = User::orderBy('first_name')->get();

        $report = [];

        foreach ($users as $user) {

            $couponCount = Coupon::where('created_by', $user->id)
                ->whereBetween('created_at', [$from, $to])
                ->count();

            $productCount = Product::where('user_id', $user->id)
                ->whereBetween('created_at', [$from, $to])
                ->count();

            $storeCount = Store::where('created_by', $user->id)
                ->whereBetween('created_at', [$from, $to])
                ->count();

            $categoryCount = Category::where('created_by', $user->id)
                ->whereBetween('created_at', [$from, $to])
                ->count();

            $report[] = [
                'user' => $user,
                'coupons' => $couponCount,
                'products' => $productCount,
                'stores' => $storeCount,
                'categories' => $categoryCount,
                'total' => $couponCount + $productCount + $storeCount + $categoryCount 
            ];
        }

        return view('admin.reports.activity-report', compact(
            'report',
            'from',
            'to'
        ));
    }
}