<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Network;
use App\Models\Admin\Store;
use App\Models\Admin\StoreFaq;
use App\Models\Admin\GeneralFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserLog;

class StoreController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $stores = Store::with(['network', 'category', 'replaceStore', 'creator', 'updater'])
            ->where('status', 'enable')
            ->whereHas('category', function ($q) use ($userId) {
                $q->where(function ($query) use ($userId) {
                    $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                        ->orWhereNull('hidden_user_ids')
                        ->orWhere('hidden_user_ids', '');
                });
            })
            ->orderBy('id', 'asc')
            ->latest()
            ->get();

        $networks = Network::orderBy('name')->get();
        $categories = Category::where(function ($query) use ($userId) {
                $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                    ->orWhereNull('hidden_user_ids')
                    ->orWhere('hidden_user_ids', '');
            })
            ->orderBy('name')
            ->get();

        $users = \App\Models\User::orderBy('username')->get();
        $allCategories = Category::pluck('name', 'id');
        return view('admin.stores.index', compact('stores', 'networks', 'categories', 'users','allCategories'));
    }

    public function create()
    {
        $userId = auth()->id();
        $networks = Network::where('status', 'enable')->orderBy('name')->get();
        $categories = Category::where('status', 'enable')
            ->where(function ($query) use ($userId) {
                $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                    ->orWhereNull('hidden_user_ids')
                    ->orWhere('hidden_user_ids', '');
            })
            ->orderBy('name')
            ->get();
        $stores = Store::orderBy('name')->get();
        $generalFaqs = GeneralFaq::where('status', 'enable')->orderBy('sort_order')->get();

        return view('admin.stores.create', compact('networks', 'categories', 'stores','generalFaqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:stores,name',
            'secondary_name' => 'nullable|string|max:255',
            'heading_h1' => 'required|string|max:255',
            'heading_h2' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'store_url' => 'required|string|max:255',
            'impression_code' => 'nullable|string',
            'html_code' => 'nullable|string',
            'description' => 'nullable|string',
            'store_title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'network_id' => 'nullable|exists:networks,id',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'faq_question' => 'nullable|array',
            'faq_question.*' => 'nullable|string|max:255',
            'faq_answer' => 'nullable|array',
            'faq_answer.*' => 'nullable|string',
            'replace_store_id' => 'nullable|exists:stores,id',
            'website' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone_no' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            
            'facebook_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'google_plus_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'pinterest_url' => 'nullable|string|max:255',
            'wikipedia_url' => 'nullable|string|max:255',
            
            'products_name' => 'nullable|string|max:255',
            'iphone_app' => 'nullable|string|max:255',
            'android_app' => 'nullable|string|max:255',
            'payment_methods' => 'nullable|string|max:255',
            'embed_code' => 'nullable|string',
        ]);

        $logoName = null;
        $thumbName = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_logo_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/stores'), $logoName);
        }

        if ($request->hasFile('thumbnail_image')) {
            $thumb = $request->file('thumbnail_image');
            $thumbName = time() . '_thumb_' . uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('uploads/stores'), $thumbName);
        }
        $status = "disable";
        // if(auth()->user()->role == 'admin'){
        //     $status = "enable";
        // }
        $store = Store::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . uniqid()),
            'secondary_name' => $request->secondary_name,
            'heading_h1' => $request->heading_h1,
            'heading_h2' => $request->heading_h2,
            'about' => $request->about,
            'domain' => $request->domain,
            'store_url' => $request->store_url,
            'impression_code' => $request->impression_code,
            'html_code' => $request->html_code,
            'description' => $request->description,
            'store_title' => $request->store_title,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'network_id' => $request->network_id,
            'category_id' => $request->category_id ? implode(',', $request->category_id) : null,
            'logo' => $logoName,
            'thumbnail_image' => $thumbName,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_category_featured' => $request->has('is_category_featured') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
            'is_top' => $request->has('is_top') ? 1 : 0,
            'status' => $status,
            'original_url' => $request->original_url,
            'replace_with_url' => $request->replace_with_url,
            'replace_store_id' => $request->replace_store_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'website' => $request->website,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            
            'facebook_url' => $request->facebook_url,
            'youtube_url' => $request->youtube_url,
            'google_plus_url' => $request->google_plus_url,
            'twitter_url' => $request->twitter_url,
            'pinterest_url' => $request->pinterest_url,
            'wikipedia_url' => $request->wikipedia_url,
            
            'products_name' => $request->products_name,
            'shipping' => $request->has('shipping') ? 1 : 0,
            'iphone_app' => $request->iphone_app,
            'android_app' => $request->android_app,
            'payment_methods' => $request->payment_methods ? implode(',', $request->payment_methods) : null,
            'embed_code' => $request->embed_code,
                    ]);

        if ($request->faq_question && is_array($request->faq_question)) {
            foreach ($request->faq_question as $index => $question) {
                $answer = $request->faq_answer[$index] ?? null;

                if (!empty($question)) {
                    StoreFaq::create([
                        'store_id' => $store->id,
                        'question' => $question,
                        'answer' => $answer,
                        'sort_order' => $index,
                        'status' => 'enable',
                    ]);
                }
            }
        }

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Add Store',
            'detail'  => "Added Store: {$request->name}",
        ]);

        return redirect()->route('admin.stores.index')->with('success', 'Store added successfully.');
    }

    public function edit($id)
    {
        $store = Store::with('faqs')->findOrFail($id);
        $networks = Network::where('status', 'enable')->orderBy('name')->get();
        $userId = auth()->id();

        $categories = Category::where('status', 'enable')
            ->where(function ($query) use ($userId) {
                $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                    ->orWhereNull('hidden_user_ids')
                    ->orWhere('hidden_user_ids', '');
            })
            ->orderBy('name')
            ->get();
        $stores = Store::where('id', '!=', $id)->orderBy('name')->get();

        return view('admin.stores.edit', compact('store', 'networks', 'categories', 'stores'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::with('faqs')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:stores,name,' . $store->id,
            'secondary_name' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'store_url' => 'required|string|max:255',
            'heading_h1' => 'required|string|max:255',
            'heading_h2' => 'required|string|max:255',
            'impression_code' => 'nullable|string',
            'html_code' => 'nullable|string',
            'description' => 'nullable|string',
            'store_title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'network_id' => 'nullable|exists:networks,id',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'faq_question' => 'nullable|array',
            'faq_question.*' => 'nullable|string|max:255',
            'faq_answer' => 'nullable|array',
            'faq_answer.*' => 'nullable|string',
            'original_url' => 'nullable|string|max:255',
            'replace_with_url' => 'nullable|string|max:255',
            'replace_store_id' => 'nullable|exists:stores,id',
            'website' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone_no' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            
            'facebook_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'google_plus_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'pinterest_url' => 'nullable|string|max:255',
            'wikipedia_url' => 'nullable|string|max:255',
            
            'products_name' => 'nullable|string|max:255',
            'iphone_app' => 'nullable|string|max:255',
            'android_app' => 'nullable|string|max:255',
            'payment_methods' => 'nullable|array',
            'payment_methods.*' => 'nullable|string',
            'embed_code' => 'nullable|string',
        ]);
        $logoName = $store->logo;
        $thumbName = $store->thumbnail_image;

        if ($request->hasFile('logo')) {
            if ($store->logo && file_exists(public_path('uploads/stores/' . $store->logo))) {
                unlink(public_path('uploads/stores/' . $store->logo));
            }

            $logo = $request->file('logo');
            $logoName = time() . '_logo_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/stores'), $logoName);
        }

        if ($request->hasFile('thumbnail_image')) {
            if ($store->thumbnail_image && file_exists(public_path('uploads/stores/' . $store->thumbnail_image))) {
                unlink(public_path('uploads/stores/' . $store->thumbnail_image));
            }

            $thumb = $request->file('thumbnail_image');
            $thumbName = time() . '_thumb_' . uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('uploads/stores'), $thumbName);
        }

        if ($request->replace_store_id == $store->id) {
            return back()->withErrors(['replace_store_id' => 'Store cannot replace itself.'])->withInput();
        }

        $store->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . $store->id),
            'secondary_name' => $request->secondary_name,
            'domain' => $request->domain,
            'store_url' => $request->store_url,
            'original_url' => $request->original_url,
            'heading_h1' => $request->heading_h1,
            'heading_h2' => $request->heading_h2,
            'about' => $request->about,
            'replace_with_url' => $request->replace_with_url,
            'impression_code' => $request->impression_code,
            'html_code' => $request->html_code,
            'description' => $request->description,
            'store_title' => $request->store_title,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'network_id' => $request->network_id,
            'category_id' => $request->category_id ? implode(',', $request->category_id) : null,
            'logo' => $logoName,
            'thumbnail_image' => $thumbName,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_category_featured' => $request->has('is_category_featured') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
            'is_top' => $request->has('is_top') ? 1 : 0,
            'replace_store_id' => $request->replace_store_id,
            'updated_by' => Auth::id(),
            'website' => $request->website,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            
            'facebook_url' => $request->facebook_url,
            'youtube_url' => $request->youtube_url,
            'google_plus_url' => $request->google_plus_url,
            'twitter_url' => $request->twitter_url,
            'pinterest_url' => $request->pinterest_url,
            'wikipedia_url' => $request->wikipedia_url,
            
            'products_name' => $request->products_name,
            'shipping' => $request->has('shipping') ? 1 : 0,
            'iphone_app' => $request->iphone_app,
            'android_app' => $request->android_app,
            'payment_methods' => $request->payment_methods ? implode(',', $request->payment_methods) : null,
            'embed_code' => $request->embed_code,
        ]);

        $store->faqs()->delete();

        if ($request->faq_question && is_array($request->faq_question)) {
            foreach ($request->faq_question as $index => $question) {
                $answer = $request->faq_answer[$index] ?? null;

                if (!empty($question)) {
                    StoreFaq::create([
                        'store_id' => $store->id,
                        'question' => $question,
                        'answer' => $answer,
                        'sort_order' => $index,
                        'status' => 'enable',
                    ]);
                }
            }
        }

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Store',
            'detail'  => "Updated Store: {$store->name}",
        ]);

        return redirect()->back()->with('success', 'Store updated successfully.');
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        if ($store->logo && file_exists(public_path('uploads/stores/' . $store->logo))) {
            unlink(public_path('uploads/stores/' . $store->logo));
        }

        if ($store->thumbnail_image && file_exists(public_path('uploads/stores/' . $store->thumbnail_image))) {
            unlink(public_path('uploads/stores/' . $store->thumbnail_image));
        }

        $store->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Store',
            'detail'  => "Deleted Store: {$store->name}",
        ]);

        return redirect()->back()->with('success', 'Store deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'status' => 'required|in:enable,disable',
        ]);

        $store->update([
            'status' => $request->status,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Store Status',
            'detail'  => "Updated Store Status: {$store->name}",
        ]);
        
        return redirect()->back()->with('success', 'Store status updated successfully.');
    }



// CONTROLLER

public function completionReport()
{
    // Sirf Pending Stores
    $stores = Store::with([
        'creator',
        'coupons',
        'products'
    ])
    ->where('status', 'disable')
    ->latest()
    ->get();

    // Cards Data
    $pendingStores = Store::where('status', 'disable')->count();

    $completedStores = Store::where('status', 'enable')->count();

    $totalCoupons = \App\Models\Admin\Coupon::count();

    return view(
        'admin.stores.completion-report',
        compact(
            'stores',
            'pendingStores',
            'completedStores',
            'totalCoupons'
        )
    );
}

public function approvalStores()
{
    $stores = Store::with([
        'creator',
        'products'
    ])
    ->withCount('coupons')
    ->where('status', 'disable')
    ->having('coupons_count', '>=', 5)
    ->latest()
    ->get();

    return view(
        'admin.stores.approval-stores',
        compact('stores')
    );
}


public function publishStore($id)
{
    $store = Store::findOrFail($id);

    $store->status = 'enable';

    $store->save();

    return redirect()
        ->back()
        ->with(
            'success',
            'Store Published Successfully'
        );
}
}