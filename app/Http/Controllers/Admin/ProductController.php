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
use App\Models\Admin\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\UserLog;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $userId = auth()->id();

            $query = Product::leftJoin('users', 'users.id', '=', 'products.user_id')
                ->leftJoin('stores', 'stores.id', '=', 'products.store_id')
                ->leftJoin('categories', 'categories.id', '=', 'stores.category_id')
                ->select('products.*', 'users.username as username')
                ->where(function ($q) use ($userId) {
                    $q->whereRaw("FIND_IN_SET(?, categories.hidden_user_ids) = 0", [$userId])
                    ->orWhereNull('categories.hidden_user_ids')
                    ->orWhere('categories.hidden_user_ids', '');
                });

            
            if ($request->search['value']) {
                $search = $request->search['value'];

                $query->where(function ($q) use ($search) {
                    $q->where('products.product_name', 'like', "%{$search}%")
                    ->orWhere('users.username', 'like', "%{$search}%");
                });
            }

            $total = $query->count();

            $products = $query->offset($request->start)
                            ->limit($request->length)
                            ->get();

            $data = [];

            foreach ($products as $row) {

                if (filter_var($row->image, FILTER_VALIDATE_URL)) {
                    $img = $row->image;
                } else {
                    $img = asset('uploads/products/' . $row->image);
                }

                $delete = route('admin.product.delete', $row->id);
                $edit = route('admin.product.edit', $row->slug);

                $data[] = [
                    'image' => '<img src="'.$img.'" width="60">',
                    'product_name' => $row->product_name,
                    'price' => '<del>'.$row->old_price.'</del><br>'.$row->current_price,
                    'date' => Carbon::parse($row->created_at)->format('F d, Y'),
                    'username' => $row->username,
                    'action' => '
                        <a class="btn btn-sm btn-primary edit" href="'.$edit.'">Edit</a>
                        <button class="btn btn-sm btn-danger delete" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-delete="'.$delete.'">Delete</button>
                    '
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $data
            ]);
        }

        return view('admin.products.index');
    }

    public function create(){
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

        
        $events = Event::all();
        $categories = Category::where(function ($q) use ($userId) {
                $q->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                ->orWhereNull('hidden_user_ids')
                ->orWhere('hidden_user_ids', '');
            })
            ->get();

             $currencies = DB::table('currencies')->get();
          
        return view('admin.products.action', compact('stores', 'events', 'categories','currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id'      => 'required|integer',
            // 'category_id'   => 'nullable|integer',
            'product_name'  => 'required|string|max:255',
            'product_title' => 'required|string|max:255',
            'old_price'     => 'nullable|string|max:255',
            'current_price' => 'required|string|max:255',
            'detail'        => 'nullable|string',
            'image'         => 'required|image|mimes:jpg,jpeg,png,webp',
            'url'           => 'required|url',
            'event_id'      => 'nullable|integer',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        $baseSlug = Str::slug($request->product_name);
        $slug = $baseSlug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $product = Product::create([
            'user_id'       => auth()->id(),
            'store_id'      => $request->store_id,
            'event_id'      => $request->event_id,
            // 'category_id'   => $request->category_id,
            'product_name'  => $request->product_name,
            'product_title' => $request->product_title,
            'old_price'     => $request->old_price,
            'current_price' => $request->current_price,
            'detail'        => $request->detail,
            'image'         => $imageName,
            'url'           => $request->url,
            'slug'          => $slug,
            'currency_code' => $request->currency_code ?? '',
            'currency_symbol' => $request->currency_symbol ?? '',
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Product',
            'detail'  => "Product created successfully | Name: {$product->product_name}, Price: {$product->current_price}",
        ]);

        return back()->with('success', 'Product Added Successfully');
    }    

    public function edit($slug)
    {
        $userId = auth()->id();

        $edit = Product::where('slug', $slug)->first();

        if (!$edit) {
            return back()->with('error', 'Product not found!');
        }

        $stores = Store::whereHas('category', function ($q) use ($userId) {
                $q->where(function ($query) use ($userId) {
                    $query->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                        ->orWhereNull('hidden_user_ids')
                        ->orWhere('hidden_user_ids', '');
                });
            })
            ->orderBy('name')
            ->get();

        $events = Event::all();
        $categories = Category::where(function ($q) use ($userId) {
                    $q->whereRaw("FIND_IN_SET(?, hidden_user_ids) = 0", [$userId])
                    ->orWhereNull('hidden_user_ids')
                    ->orWhere('hidden_user_ids', '');
                })
                ->get();

                $currencies = DB::table('currencies')->get();
        return view('admin.products.action', compact('edit', 'stores', 'events', 'categories','currencies'));
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $request->validate([
            'store_id'      => 'required|integer',
            // 'category_id'   => 'nullable|integer',
            'product_name'  => 'required|string|max:255',
            'product_title' => 'required|string|max:255',
            'old_price'     => 'nullable|string|max:255',
            'current_price' => 'required|string|max:255',
            'detail'        => 'nullable|string',
            'url'           => 'required|url',

            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp',

            'event_id'      => 'nullable|integer',
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        if ($product->product_name !== $request->product_name) {

            $baseSlug = Str::slug($request->product_name);
            $slug = $baseSlug;
            $counter = 1;

            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

        } else {
            $slug = $product->slug;
        }

        $product->update([
            'store_id'      => $request->store_id,
            'event_id'      => $request->event_id,
            // 'category_id'   => $request->category_id,
            'product_name'  => $request->product_name,
            'product_title' => $request->product_title,
            'old_price'     => $request->old_price,
            'current_price' => $request->current_price,
            'detail'        => $request->detail,
            'image'         => $imageName,
            'url'           => $request->url,
            'slug'          => $slug,
            'currency_code' => $request->currency_code ?? '',
            'currency_symbol' => $request->currency_symbol ?? '',
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Product',
            'detail'  => "Product updated successfully | Name: {$product->product_name}, Price: {$product->current_price}",
        ]);

        return redirect()->route("admin.product.index")->with('success', 'Product Updated Successfully');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        if (!$product) {
            return back()->with('error', 'Product not found!');
        }
        if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL)) {
            $path = public_path('uploads/products/' . $product->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Product',
            'detail'  => "Product deleted successfully | Name: {$product->product_name}",
        ]);

        return back()->with('success', 'Product Deleted Successfully');
    }

    public function frontPage(Request $request){
        $products = Product::with(['category', 'store','event'])
        ->activeFilters();

        if($request->store){
            $products->whereHas('store', function($q) use ($request){
                $q->where('slug', $request->store);
            });
        }

        // if($request->category){
        //     $products->whereHas('category', function($q) use ($request){
        //         $q->where('slug', $request->category);
        //     });
        // }

        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $products->whereHas('store', function ($q) use ($category) {
                    $q->whereRaw("FIND_IN_SET(?, category_id)", [$category->id]);
                });
            }
        }

        $products = $products->latest()->paginate(25);

        $stores = Store::where('status', 'enable')
            ->whereRaw("
                EXISTS (
                    SELECT 1
                    FROM categories cat
                    WHERE FIND_IN_SET(cat.id, stores.category_id)
                    AND cat.status = 'enable'
                )
            ")
            ->whereRaw("
                EXISTS (
                    SELECT 1
                    FROM products pro
                    WHERE pro.store_id = stores.id
                )
            ")
            ->inRandomOrder()
            ->limit(12)
            ->get();

        $categories = Category::where('status', 'enable')
            ->whereRaw("
                EXISTS (
                    SELECT 1 
                    FROM stores s
                    WHERE FIND_IN_SET(categories.id, s.category_id)
                    AND s.status = 'enable'
                    AND EXISTS (
                        SELECT 1 
                        FROM products pro
                        WHERE pro.store_id = s.id
                    )
                )
            ")
            ->inRandomOrder()
            ->limit(12)
            ->get();

        // $letestStores = Store::where('status', 'enable')
        //     ->latest()
        //     ->limit(4)
        //     ->get();

        $featuredStores = Store::where('status', 'enable')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('categories')
                    ->where('categories.status', 'enable')
                    ->whereRaw("FIND_IN_SET(categories.id, stores.category_id)");
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereColumn('products.store_id', 'stores.id');
            })
            ->latest()
            ->limit(4)
            ->get();

        if ($featuredStores->count() < 4) {
            $remaining = 4 - $featuredStores->count();
            $otherStores = Store::where('status', 'enable')
                ->whereNotIn('id', $featuredStores->pluck('id'))
                
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('categories')
                        ->where('categories.status', 'enable')
                        ->whereRaw("FIND_IN_SET(categories.id, stores.category_id)");
                })
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('products')
                        ->whereColumn('products.store_id', 'stores.id');
                })
                ->latest()
                ->limit($remaining)
                ->get();

            $letestStores = $featuredStores->merge($otherStores);

        } else {
            $letestStores = $featuredStores;
        }
            
        return view('product', compact('products', 'stores', 'categories', 'letestStores'));
    }



    public function searchProducts(Request $request)
{
    $search = $request->search;

    $products = Product::with(['store'])
        ->where(function ($q) use ($search) {

            $q->where('product_name', 'LIKE', "%{$search}%")

              ->orWhereHas('store', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
              });

        })
        ->latest()
        ->take(25)
        ->get();

    return response()->json($products);
}
}