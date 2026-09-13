<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Store;
use App\Models\Admin\Product;
use App\Models\Admin\Coupon;
use App\Models\Admin\BestCoupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserLog;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();
        $users = User::where('trash', 0)->where('role', 'manager')->where('status', 'active')->orderBy('first_name')->get();

        return view('admin.categories.create', compact('parentCategories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:enable,disable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_sensitive' => 'nullable|boolean',
            'hidden_user_ids' => 'nullable|array',
            'hidden_user_ids.*' => 'exists:users,id',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
        }

        $hiddenUserIds = $request->hidden_user_ids
            ? implode(',', $request->hidden_user_ids)
            : null;

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . uniqid()),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'parent_id' => $request->parent_id ?: null,
            'status' => $request->status,
            'mark_home' => $request->has('mark_home') ? 1 : 0,
            'is_sensitive' => $request->has('is_sensitive') ? 1 : 0,
            'hidden_user_ids' => $hiddenUserIds,
            'created_by' => auth()->id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Category',
            'detail'  => "Created Category: {$request->name}",
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('name')
            ->get();

        $users = User::where('trash', 0)->where('status', 'active')->where('role', 'manager')->orderBy('first_name')->get();

        return view('admin.categories.edit', compact('category', 'parentCategories', 'users'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:enable,disable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_sensitive' => 'nullable|boolean',
            'hidden_user_ids' => 'nullable|array',
            'hidden_user_ids.*' => 'exists:users,id',
        ]);

        if ($request->parent_id == $id) {
            return back()->withErrors([
                'parent_id' => 'Category cannot be its own parent.'
            ])->withInput();
        }

        $imageName = $category->image;

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                unlink(public_path('uploads/categories/' . $category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
        }

        $hiddenUserIds = $request->hidden_user_ids
            ? implode(',', $request->hidden_user_ids)
            : null;

        $category->update([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'parent_id' => $request->parent_id ?: null,
            'status' => $request->status,
            'mark_home' => $request->has('mark_home') ? 1 : 0,
            'is_sensitive' => $request->has('is_sensitive') ? 1 : 0,
            'hidden_user_ids' => $hiddenUserIds,
            'updated_by' => auth()->id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Category',
            'detail'  => "Updated Category: {$request->name}",
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
            unlink(public_path('uploads/categories/' . $category->image));
        }

        $stores = Store::all();
        foreach ($stores as $store) {

            $categories = array_filter(explode(',', $store->category_id));
            if (in_array($category->id, $categories)) {
                if (count($categories) == 1) {

                    $products = Product::where('store_id', $store->id)->get();
                    foreach ($products as $product) {

                        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                            unlink(public_path('uploads/products/' . $product->image));
                        }

                        $product->delete();
                    }

                    Coupon::where('store_id', $store->id)->delete();
                    BestCoupon::where('store_id', $store->id)->delete();
                    
                    if ($store->logo && file_exists(public_path('uploads/stores/' . $store->logo))) {
                        unlink(public_path('uploads/stores/' . $store->logo));
                    }

                    if ($store->thumbnail_image && file_exists(public_path('uploads/stores/' . $store->thumbnail_image))) {
                        unlink(public_path('uploads/stores/' . $store->thumbnail_image));
                    }

                    $store->delete();

                } else {
                    $updatedCategories = array_diff($categories, [$category->id]);
                    $store->update([
                        'category_id' => implode(',', $updatedCategories)
                    ]);
                }
            }
        }

        $category->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Category',
            'detail'  => "Deleted Category: {$category->name}",
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}