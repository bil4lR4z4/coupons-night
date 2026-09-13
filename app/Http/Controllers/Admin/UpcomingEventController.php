<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UpcomingEvent;
use App\Models\Product;
use App\Models\Admin\Store;
use App\Models\Admin\Coupon;
use App\Models\Admin\Category;
use App\Models\UserLog;
use App\Models\Setting;

class UpcomingEventController extends Controller
{
    public function index()
    {
        $events = UpcomingEvent::latest()->get();

        return view('admin.upcoming-events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.upcoming-events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/events'), $imageName);
        }

        UpcomingEvent::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'badge_text' => $request->badge_text,
            'background_color' => $request->background_color,
            'button_color' => $request->button_color,
            'image' => $imageName,
            'status' => $request->status ?? 1,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'create upcoming event',
            'detail'  => "Event Added Successfully. Title: {$request->title}",
        ]);
        return redirect()->route('admin.upcoming-events.index')
            ->with('success', 'Event Added Successfully');
    }

    public function edit($id)
    {
        $event = UpcomingEvent::findOrFail($id);

        return view('admin.upcoming-events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = UpcomingEvent::findOrFail($id);

        $imageName = $event->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/events'), $imageName);
        }

        $event->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'badge_text' => $request->badge_text,
            'background_color' => $request->background_color,
            'button_color' => $request->button_color,
            'image' => $imageName,
            'status' => $request->status ?? 1,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'update upcoming event',
            'detail'  => "Event Updated Successfully. Title: {$request->title}",
        ]);

        return redirect()->back()
            ->with('success', 'Event Updated Successfully');
    }

    public function destroy($id)
    {
        $event = UpcomingEvent::findOrFail($id);

        $event->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'delete upcoming event',
            'detail'  => "Event Deleted Successfully. Title: {$event->title}",
        ]);
        
        return redirect()->back()
            ->with('success', 'Event Deleted Successfully');
    }


    public function frontend()
    {

        $events = UpcomingEvent::where('status', 1)->where('end_date', '>', now())->orderBy('start_date')->get();

        $products = Product::latest()
                    ->take(8)
                    ->get();

        $stores = Store::latest()
                    ->take(8)
                    ->get();

        $coupons = Coupon::latest()
                    ->take(8)
                    ->get();

        $categories = Category::latest()
                    ->take(8)
                    ->get();

        $storeCount = Store::count();

        $nextEvent = UpcomingEvent::where('status', 1)
            ->whereDate('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->first();

        $popularStores = Store::withCount([
                'coupons' => function ($q) {
                    $q->where('status', 'enable');
                }
            ])
            ->where('status', 'enable')
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
            ->orderBy('coupons_count', 'desc')
            ->take(8)
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
            ->latest()
            ->limit(6)
            ->get();

        $featuredCoupons = Coupon::with(['category', 'store', 'event'])
            ->activeFilters()
            ->latest()
            ->take(12)
            ->get();

            // dd($featuredCoupons);
          
       $setting = Setting::first();
        return view('upcoming', compact(

            'events',
            'products',
            'stores',
            'coupons',
            'categories',
            'storeCount',
            'nextEvent',
            'popularStores',
            'popularCategories',
            'featuredCoupons',
            'setting'
        ));
    }
}