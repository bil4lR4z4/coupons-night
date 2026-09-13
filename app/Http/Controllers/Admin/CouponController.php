<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Coupon;
use App\Models\Admin\CouponVote;
use App\Models\Admin\Event;
use App\Models\Admin\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class CouponController extends Controller
{
public function index(Request $request)
{
    $query = Coupon::with([
        'store',
        'creator'
    ]);


    if ($request->store_id) {

        $query->where(
            'store_id',
            $request->store_id
        );

    }

    $coupons = $query
        ->latest()
        ->get();

    return view(
        'admin.coupons.index',
        compact('coupons')
    );
}


    public function create()
    {
        $userId = auth()->id();

        $stores = Store::whereHas('category', function ($q) use ($userId) {
            $q->where(function ($query) use ($userId) {
                $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                      ->orWhereNull('hidden_user_ids')
                      ->orWhere('hidden_user_ids', '');
            });
        })
        ->orderBy('name')
        ->get();

        $categories = Category::where('status', 'enable')
            ->where(function ($q) use ($userId) {
                $q->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                ->orWhereNull('hidden_user_ids')
                ->orWhere('hidden_user_ids', '');
            })
            ->orderBy('name')
            ->get();

        $events = Event::where('status', 'enable')->orderBy('name')->get();

        return view('admin.coupons.create', compact('stores', 'categories', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'event_id' => 'nullable|exists:events,id',
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'coupon_code' => 'required_unless:is_no_code,on|nullable|string|max:255',
            'coupon_image_line_1' => 'nullable|string|max:255',
            'coupon_image_line_2' => 'nullable|string|max:255',
            'coupon_image_line_3' => 'nullable|string|max:255',
            'html_code' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:enable,disable',
            'date_type' => 'required|in:text,calendar',
            'date_text' => 'nullable|string|max:255',
        ]);

        $coupon = Coupon::create([
            'store_id' => $request->store_id,
            'event_id' => $request->event_id,
            'name' => $request->name,
            'detail' => $request->detail,
            'coupon_code' => $request->coupon_code,
            'coupon_image_line_1' => $request->coupon_image_line_1,
            'coupon_image_line_2' => $request->coupon_image_line_2,
            'coupon_image_line_3' => $request->coupon_image_line_3,
            'html_code' => $request->html_code,
'start_date' => $request->date_type == 'calendar'
    ? $request->start_date
    : null,

'end_date' => $request->date_type == 'calendar'
    ? $request->end_date
    : null,

'date_text' => $request->date_type == 'text'
    ? $request->date_text
    : null,
            'date_type' => $request->date_type,
'sort_order' => Coupon::max('sort_order') + 1,
            'is_exclusive' => $request->has('is_exclusive') ? 1 : 0,
            'free_shipping' => $request->has('free_shipping') ? 1 : 0,
            'is_homepage' => $request->has('is_homepage') ? 1 : 0,
            'is_top_category' => $request->has('is_top_category') ? 1 : 0,
            'is_special_offer' => $request->has('is_special_offer') ? 1 : 0,
            'is_verified' => $request->has('is_verified') ? 1 : 0,
            'is_no_code' => $request->has('is_no_code') ? 1 : 0,
            'rank' => $request->rank ?? 0,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        CouponVote::create([
            'coupon_id' => $coupon->id,
            'likes' => 0,
            'dislikes' => 0,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Coupon',
            'detail'  => "Created Coupon: {$coupon->name}",
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon added successfully.');
    }

    public function edit($id)
    {
        $userId = auth()->id();

        $coupon = Coupon::with('vote')->findOrFail($id);
        $stores = Store::whereHas('category', function ($q) use ($userId) {
                $q->where(function ($query) use ($userId) {
                    $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                        ->orWhereNull('hidden_user_ids')
                        ->orWhere('hidden_user_ids', '');
                });
            })
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', 'enable')
            ->where(function ($q) use ($userId) {
                $q->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                ->orWhereNull('hidden_user_ids')
                ->orWhere('hidden_user_ids', '');
            })
            ->orderBy('name')
            ->get();
        $events = Event::where('status', 'enable')->orderBy('name')->get();

        return view('admin.coupons.edit', compact('coupon', 'stores', 'categories', 'events'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'event_id' => 'nullable|exists:events,id',
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'coupon_code' => 'required_unless:is_no_code,on|nullable|string|max:255',
            'coupon_image_line_1' => 'nullable|string|max:255',
            'coupon_image_line_2' => 'nullable|string|max:255',
            'coupon_image_line_3' => 'nullable|string|max:255',
            'html_code' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'rank' => 'nullable|integer|min:0',
            'status' => 'required|in:enable,disable',
            'date_type' => 'required|in:text,calendar',
            'date_text' => 'nullable|string|max:255',
        ]);

        $coupon->update([
            'store_id' => $request->store_id,
            'event_id' => $request->event_id,
            'name' => $request->name,
            'detail' => $request->detail,
            'coupon_code' => $request->coupon_code,
            'coupon_image_line_1' => $request->coupon_image_line_1,
            'coupon_image_line_2' => $request->coupon_image_line_2,
            'coupon_image_line_3' => $request->coupon_image_line_3,
            'html_code' => $request->html_code,
            'date_type' => $request->date_type,
'start_date' => $request->date_type == 'calendar'
    ? $request->start_date
    : null,

'end_date' => $request->date_type == 'calendar'
    ? $request->end_date
    : null,

'date_text' => $request->date_type == 'text'
    ? $request->date_text
    : null,
            'is_exclusive' => $request->has('is_exclusive') ? 1 : 0,
            'free_shipping' => $request->has('free_shipping') ? 1 : 0,
            'is_homepage' => $request->has('is_homepage') ? 1 : 0,
            'is_top_category' => $request->has('is_top_category') ? 1 : 0,
            'is_special_offer' => $request->has('is_special_offer') ? 1 : 0,
            'is_verified' => $request->has('is_verified') ? 1 : 0,
            'is_no_code' => $request->has('is_no_code') ? 1 : 0,
            'rank' => $request->rank ?? 0,
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ]);

        if (!$coupon->vote) {
            CouponVote::create([
                'coupon_id' => $coupon->id,
                'likes' => 0,
                'dislikes' => 0,
            ]);
        }

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Coupon',
            'detail'  => "Updated Coupon: {$coupon->name}",
        ]);

        return redirect()->back()->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Coupon',
            'detail'  => "Deleted Coupon: {$coupon->name}",
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon removed successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'status' => 'required|in:enable,disable',
        ]);

        $coupon->update([
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Coupon Status',
            'detail'  => "Updated Coupon Status: {$coupon->name}",
        ]);
        
        return redirect()->back()->with('success', 'Coupon status updated successfully.');
    }

    public function sortCoupons(Request $request)
{
    $ids = $request->ids;

    foreach ($ids as $index => $id) {
        Coupon::where('id', $id)->update([
            'sort_order' => $index + 1
        ]);
    }

    return response()->json([
        'success' => true
    ]);
}
    public function activeByStore()
    {
        $stores = Store::where('status', 'enable')
            ->with(['coupons' => function ($q) {
                $q->where('status', 'enable')->with('vote')->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        return view('admin.coupons.active-by-store', compact('stores'));
    }

    public function saveVotes(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'likes' => 'nullable|integer|min:0',
            'dislikes' => 'nullable|integer|min:0',
        ]);

        CouponVote::updateOrCreate(
            ['coupon_id' => $coupon->id],
            [
                'likes' => $request->likes ?? 0,
                'dislikes' => $request->dislikes ?? 0,
            ]
        );

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Coupon Votes',
            'detail'  => "Updated Coupon Votes: {$coupon->name}",
        ]);
        
        return redirect()->back()->with('success', 'Coupon votes updated successfully.');
    }
}