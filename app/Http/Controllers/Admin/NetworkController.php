<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserLog;
use App\Models\Admin\Store;
use App\Models\Admin\Coupon;
use App\Models\Product;
use App\Models\Admin\Event;
use App\Models\Admin\UpcomingEvent;

class NetworkController extends Controller
{
    public function index()
    {
        $networks = Network::latest()->get();
        return view('admin.networks.index', compact('networks'));
    }

    public function create()
    {
        return view('admin.networks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:networks,name',
            'color' => 'nullable|string|max:20',
            'status' => 'required|in:enable,disable',
        ]);

        Network::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color ?: '#000000',
            'status' => $request->status,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Network',
            'detail'  => "Network created successfully | Name: {$request->name}",
        ]);

        return redirect()->route('admin.networks.index')->with('success', 'Network added successfully.');
    }

    public function edit($id)
    {
        $network = Network::findOrFail($id);
        return view('admin.networks.edit', compact('network'));
    }

    public function update(Request $request, $id)
    {
        $network = Network::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:networks,name,' . $network->id,
            'color' => 'nullable|string|max:20',
            'status' => 'required|in:enable,disable',
        ]);

        $network->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color ?: '#000000',
            'status' => $request->status,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Network',
            'detail'  => "Network updated successfully | Name: {$request->name}",
        ]);

        return redirect()->back()->with('success', 'Network updated successfully.');
    }

    public function destroy($id)
    {
        $network = Network::findOrFail($id);
        $network->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Network',
            'detail'  => "Network deleted successfully | Name: {$network->name}",
        ]);
        
        return redirect()->route('admin.networks.index')->with('success', 'Network deleted successfully.');
    }



    public function details($id)
{
    $network = Network::findOrFail($id);

    // Store IDs
    $storeIds = Store::where('network_id', $id)->pluck('id');

    // Counts
    $totalStores = Store::where('network_id', $id)->count();

    $totalCoupons = Coupon::whereIn('store_id', $storeIds)->count();

    $totalProducts = Product::whereIn('store_id', $storeIds)->count();

    // $totalEvents = Event::where('store_id', $id)->count();

    // $upcomingEvents = UpcomingEvent::where('store_id', $id)->count();

    return view('admin.networks.details', compact(
        'network',
        'totalStores',
        'totalCoupons',
        'totalProducts',
        // 'totalEvents',
    ));
}
}