<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Setting;
use App\Models\Admin\Store;
use App\Models\Admin\Category;
use App\Models\Admin\Event;
use App\Models\Admin\BlogPost;
use App\Models\Marque;
use App\Models\Product;


class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public $setting;
    public $stores;
    public $categories;
    public $events;
    public $blogCategories;
    public $marques;
    public $products;

    public function __construct()
    {
        $this->setting = Setting::first();
        $this->stores = Store::where('status', 'enable')
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
            ->latest()
            ->limit(10)
            ->get();

        $this->categories = Category::where('status', 'enable')
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
            ->limit(10)
            ->get();

        // $this->events = Event::where('status', 'enable')
        //         ->whereHas('coupons', function ($query) {
        //                 $query->where('status', 'enable');
        //             })->latest()->limit(10)->get();

        $this->events = Event::where('status', 'enable')
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
    ->latest()
    ->limit(10)
    ->get();
                    
        $this->blogCategories = Category::whereHas('blogPosts')
            ->with([
                'blogPosts' => function ($q) {
                    $q->where('status', 'enable')
                    ->latest()
                    ->limit(5);
                }
            ])
            ->where('status', 'enable')
            ->get();

        $this->marques = Marque::all();
        $this->products = Product::latest()->limit(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
