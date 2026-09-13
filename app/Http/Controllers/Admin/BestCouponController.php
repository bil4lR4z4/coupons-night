<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BestCoupon;
use App\Models\Admin\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class BestCouponController extends Controller
{
    public function index()
    {
        $bestCoupons = BestCoupon::with(['store', 'creator'])->latest()->get();
        return view('admin.best-coupons.index', compact('bestCoupons'));
    }

    public function create()
    {
        $userId = auth()->id();

        $stores = Store::where('status', 'enable')
            ->whereHas('category', function ($q) use ($userId) {
                $q->where(function ($query) use ($userId) {
                    $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                        ->orWhereNull('hidden_user_ids')
                        ->orWhere('hidden_user_ids', '');
                });
            })
            ->orderBy('name')
            ->get();

        return view('admin.best-coupons.create', compact('stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'title' => 'required|string|max:255',
            'html_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_best_coupon_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/best-coupons'), $imageName);
        }

        BestCoupon::create([
            'store_id' => $request->store_id,
            'title' => $request->title,
            'html_link' => $request->html_link,
            'image' => $imageName,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Add Best Coupon',
            'detail'  => "Added Best Coupon: {$request->title}",
        ]);

        return redirect()->route('admin.best-coupons.index')->with('success', 'Best coupon added successfully.');
    }

    public function edit($id)
{
    $bestCoupon = BestCoupon::findOrFail($id);
    $userId = auth()->id();

    $stores = Store::where('status', 'enable')
        ->whereHas('category', function ($q) use ($userId) {
            $q->where(function ($query) use ($userId) {
                $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                      ->orWhereNull('hidden_user_ids')
                      ->orWhere('hidden_user_ids', '');
            });
        })
        ->orderBy('name')
        ->get();

    return view('admin.best-coupons.edit', compact('bestCoupon', 'stores'));
}

    public function update(Request $request, $id)
    {
        $bestCoupon = BestCoupon::findOrFail($id);

        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'title' => 'required|string|max:255',
            'html_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imageName = $bestCoupon->image;

        if ($request->hasFile('image')) {
            if ($bestCoupon->image && file_exists(public_path('uploads/best-coupons/' . $bestCoupon->image))) {
                unlink(public_path('uploads/best-coupons/' . $bestCoupon->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_best_coupon_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/best-coupons'), $imageName);
        }

        $bestCoupon->update([
            'store_id' => $request->store_id,
            'title' => $request->title,
            'html_link' => $request->html_link,
            'image' => $imageName,
            'updated_by' => Auth::id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Best Coupon',
            'detail'  => "Updated Best Coupon: {$bestCoupon->title}",
        ]);

        return redirect()->back()->with('success', 'Best coupon updated successfully.');
    }

    public function destroy($id)
    {
        $bestCoupon = BestCoupon::findOrFail($id);

        if ($bestCoupon->image && file_exists(public_path('uploads/best-coupons/' . $bestCoupon->image))) {
            unlink(public_path('uploads/best-coupons/' . $bestCoupon->image));
        }

        $bestCoupon->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Best Coupon',
            'detail'  => "Deleted Best Coupon: {$bestCoupon->title}",
        ]);
        
        return redirect()->route('admin.best-coupons.index')->with('success', 'Best coupon deleted successfully.');
    }
}