<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function frontend($slug)
    {
        $events = Event::where('status', 'enable')
            ->where('slug', $slug)
            ->first();

    $eventsCoupons = Coupon::with(['category', 'store', 'event'])
    ->activeFilters()
    ->where('event_id', $events->id)
    ->where('status', 'enable')
    ->paginate(25);
// dd($eventsCoupons);
        // $deals = Coupon::where('is_no_code', 1)
        //     ->where('is_verified', 1)
        //     ->where('is_homepage', 1)
        //     ->orderBy('sort_order', 'asc')
        //     ->where('status', 'enable')
        //     ->with('store')
        //     ->limit(5)
        //     ->get();

        return view('event', compact('events','eventsCoupons'));
    }

    public function allevents()
    {
        $events = Event::where('status', 'enable')
            ->whereRaw("
                EXISTS (
                    SELECT 1
                    FROM coupons c
                    INNER JOIN stores s ON s.id = c.store_id
                    WHERE c.event_id = events.id
                    AND c.status = 'enable'
                    AND s.status = 'enable'
                    AND EXISTS (
                        SELECT 1
                        FROM categories cat
                        WHERE FIND_IN_SET(cat.id, s.category_id)
                        AND cat.status = 'enable'
                    )
                )
            ")
            ->get();

        return view('all-events', compact('events'));
    }
    
}