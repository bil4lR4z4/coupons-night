<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\BlogPost;
use App\Models\Admin\Category;
use App\Models\Admin\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BlogController extends Controller
{
public function blog()
{
    $featuredArticle = BlogPost::with('categories')
        ->where('status', 'enable')
        ->where('is_featured_article', 1)
        ->latest()
        ->first();

    $featuredReads = BlogPost::with('categories')
        ->where('status', 'enable')
        ->where('is_featured', 1)
        ->latest()
        ->take(4)
        ->get();

    $posts = BlogPost::with('categories')
        ->where('status', 'enable')
        ->latest()
        ->paginate(25);

    // $categories = Category::whereNull('parent_id')
    //     ->with('children')
    //     ->orderBy('name', 'asc')
    //     ->get();

    $categories = Category::whereNull('parent_id')
        ->where('status', 'enable')

        ->whereHas('blogPosts', function ($q) {
            $q->where('status', 'enable');
        })

        ->with([
            'children' => function ($q) {
                $q->where('status', 'enable')
                ->whereHas('blogPosts', function ($q2) {
                    $q2->where('status', 'enable');
                })
                ->orderBy('name', 'asc');
            }
        ])

        ->orderBy('name', 'asc')
        ->get();

    return view('blog', compact(
        'featuredArticle',
        'featuredReads',
        'posts',
        'categories'
    ));
}

    
public function blogDetail($slug)
{
    $post = BlogPost::with([
            'categories',
            'faqs' => function ($query) {
                $query->where('status', 'enable')->orderBy('sort_order', 'asc');
            }
        ])
        ->where('status', 'enable')
        ->where('slug', $slug)
        ->firstOrFail();

    $popularPosts = BlogPost::with(['categories' => function ($q) {
            $q->where('status', 'enable');
        }])
        ->where('status', 'enable')
        ->where('id', '!=', $post->id)

        ->whereHas('categories', function ($q) {
            $q->where('status', 'enable');
        })

        ->latest()
        ->take(4)
        ->get();
 
    $categories = Category::whereNull('parent_id')
        ->where('status', 'enable')

        ->whereHas('blogPosts', function ($q) {
            $q->where('status', 'enable');
        })

        ->with([
            'children' => function ($q) {
                $q->where('status', 'enable')
                ->whereHas('blogPosts', function ($q2) {
                    $q2->where('status', 'enable');
                })
                ->orderBy('name', 'asc');
            }
        ])

        ->orderBy('name', 'asc')
        ->get();

     $latestStore = Product::latest()->first();
        //  dd($latestStore);
    return view('blogdetail', compact('post', 'popularPosts', 'categories','latestStore'));
}
}