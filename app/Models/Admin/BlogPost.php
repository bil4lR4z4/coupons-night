<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;
class BlogPost extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'meta_description',
        'short_description',
        'description',
        'image',
        'author_name',
        'author_image',
        'badge_text',
        'read_time',
        'published_date',
        'is_featured',
        'is_featured_article',
        'status',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_post_category');
    }

    public function faqs()
    {
        return $this->hasMany(BlogPostFaq::class, 'blog_post_id')->orderBy('sort_order', 'asc');
    }

    protected static function booted()
    {
        static::deleting(function ($blog) {

            // Delete image
            if ($blog->image && File::exists(public_path('uploads/blogs/' . $blog->image))) {
                File::delete(public_path('uploads/blogs/' . $blog->image));
            }

            // Delete author image
            if ($blog->author_image && File::exists(public_path('uploads/blogs/' . $blog->author_image))) {
                File::delete(public_path('uploads/blogs/' . $blog->author_image));
            }

            // Delete FAQs
            $blog->faqs()->delete();

            // Detach categories
            $blog->categories()->detach();

        });
    }
}