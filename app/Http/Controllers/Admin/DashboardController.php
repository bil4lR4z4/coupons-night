<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Admin\Store;
use App\Models\Admin\Event;
use App\Models\Admin\UpcomingEvent;
use App\Models\Admin\Coupon;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $totalProducts = Product::count();
        $totalStores = Store::count();
        $totalEvents = Event::count();
        $upcomingEvents = UpcomingEvent::count();
        $totalCoupons = Coupon::count();
        $ApprovedStores = Store::where('status','enable')->count();
          $PendingStores = Store::where('status','disable')->count();
        return view('admin.dashboard', compact('totalProducts', 'totalStores', 'totalEvents', 'upcomingEvents', 'totalCoupons','ApprovedStores','PendingStores'));
    }

    

}