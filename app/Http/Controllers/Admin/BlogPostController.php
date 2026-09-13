<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BlogPost;
use App\Models\Admin\BlogPostFaq;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserLog;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('categories')->latest()->get();

        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->where('status','enable')
            ->with('children')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.blog-posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'categories' => 'required|array',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'badge_text' => 'required|string|max:255',
            'read_time' => 'nullable|string|max:255',
            'published_date' => 'required|date',
            'is_featured' => 'nullable|in:0,1',
            'is_featured_article' => 'nullable|in:0,1',
            'status' => 'required|in:enable,disable',

            'faq_question' => 'nullable|array',
            'faq_question.*' => 'nullable|string|max:255',
            'faq_answer' => 'nullable|array',
            'faq_answer.*' => 'nullable|string',
            'faq_sort_order' => 'nullable|array',
            'faq_sort_order.*' => 'nullable|integer',
            'faq_status' => 'nullable|array',
            'faq_status.*' => 'nullable|in:enable,disable',
        ]);

        $imagePath = null;
        $authorImagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_blog_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $imagePath = 'uploads/blogs/' . $filename;
        }

        if ($request->hasFile('author_image')) {
            $file = $request->file('author_image');
            $filename = time() . '_author_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $authorImagePath = 'uploads/blogs/' . $filename;
        }

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $post = BlogPost::create([
            'name' => $request->name,
            'title' => $request->title,
            'slug' => $slug,
            'meta_description' => $request->meta_description,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $imagePath,
            'author_name' => $request->author_name,
            'author_image' => $authorImagePath,
            'badge_text' => $request->badge_text,
            'read_time' => $request->read_time,
            'published_date' => $request->published_date,
            'is_featured' => $request->is_featured ?? 0,
            'is_featured_article' => $request->is_featured_article ?? 0,
            'status' => $request->status,
        ]);

        $post->categories()->sync($request->categories ?? []);

        $this->saveFaqs($request, $post->id);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create',
            'detail'  => "Blog post added successfully",
        ]);
        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post added successfully.');
    }

    public function edit($id)
    {
        $post = BlogPost::with(['categories', 'faqs'])->findOrFail($id);

        $categories = Category::whereNull('parent_id')
            ->where('status','enable')
            ->with('children')
            ->orderBy('name', 'asc')
            ->get();

        $selectedCategories = $post->categories->pluck('id')->toArray();

        return view('admin.blog-posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $post->id,
            'categories' => 'required|array',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'badge_text' => 'required|string|max:255',
            'read_time' => 'nullable|string|max:255',
            'published_date' => 'required|date',
            'is_featured' => 'nullable|in:0,1',
            'is_featured_article' => 'nullable|in:0,1',
            'status' => 'required|in:enable,disable',

            'faq_question' => 'nullable|array',
            'faq_question.*' => 'nullable|string|max:255',
            'faq_answer' => 'nullable|array',
            'faq_answer.*' => 'nullable|string',
            'faq_sort_order' => 'nullable|array',
            'faq_sort_order.*' => 'nullable|integer',
            'faq_status' => 'nullable|array',
            'faq_status.*' => 'nullable|in:enable,disable',
        ]);

        $imagePath = $post->image;
        $authorImagePath = $post->author_image;

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $file = $request->file('image');
            $filename = time() . '_blog_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $imagePath = 'uploads/blogs/' . $filename;
        }

        if ($request->hasFile('author_image')) {
            if ($post->author_image && file_exists(public_path($post->author_image))) {
                unlink(public_path($post->author_image));
            }

            $file = $request->file('author_image');
            $filename = time() . '_author_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $authorImagePath = 'uploads/blogs/' . $filename;
        }

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $post->update([
            'name' => $request->name,
            'title' => $request->title,
            'slug' => $slug,
            'meta_description' => $request->meta_description,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $imagePath,
            'author_name' => $request->author_name,
            'author_image' => $authorImagePath,
            'badge_text' => $request->badge_text,
            'read_time' => $request->read_time,
            'published_date' => $request->published_date,
            'is_featured' => $request->is_featured ?? 0,
            'is_featured_article' => $request->is_featured_article ?? 0,
            'status' => $request->status,
        ]);

        $post->categories()->sync($request->categories ?? []);

        BlogPostFaq::where('blog_post_id', $post->id)->delete();
        $this->saveFaqs($request, $post->id);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update',
            'detail'  => "Blog post updated successfully.",
        ]);

        return redirect()
            ->back()
            ->with('success', 'Blog post updated successfully.');
    }

    private function saveFaqs(Request $request, $blogPostId)
    {
        if (!$request->faq_question) {
            return;
        }

        foreach ($request->faq_question as $index => $question) {
            if (!$question) {
                continue;
            }

            BlogPostFaq::create([
                'blog_post_id' => $blogPostId,
                'question' => $question,
                'answer' => $request->faq_answer[$index] ?? null,
                'sort_order' => $request->faq_sort_order[$index] ?? 0,
                'status' => $request->faq_status[$index] ?? 'enable',
            ]);
        }
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        if ($post->author_image && file_exists(public_path($post->author_image))) {
            unlink(public_path($post->author_image));
        }

        $post->categories()->detach();
        $post->faqs()->delete();
        $post->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete',
            'detail'  => "Blog post deleted successfully.",
        ]);
        
        return redirect()
            ->route('admin.blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}