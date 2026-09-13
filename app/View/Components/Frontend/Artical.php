<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Admin\BlogPost;

class Artical extends Component
{
    public $posts;
    public function __construct()
    {
        $this->posts = BlogPost::with('categories')->latest()->take(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.artical');
    }
}
