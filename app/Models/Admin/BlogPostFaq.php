<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogPostFaq extends Model
{
    protected $table = 'blog_post_faqs';

    protected $fillable = [
        'blog_post_id',
        'question',
        'answer',
        'sort_order',
        'status',
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}