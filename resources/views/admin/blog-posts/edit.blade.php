@extends('admin.master')

@section('title', 'Edit Blog Post')

@section('content')
<style>
    /* Editor ka white background */
.note-editor .note-editable{
    background: #fff !important;
    color: #000 !important;
}

/* Fullscreen editor fix */
.note-editor.fullscreen{
    z-index: 999999 !important;
    background: #fff !important;
}

/* Fullscreen content area */
.note-editor.fullscreen .note-editable{
    background: #fff !important;
    padding: 20px;
}

/* Toolbar background */
.note-editor.fullscreen .note-toolbar{
    background: #fff !important;
}

/* Scroll fix */
body.modal-open,
body.fullscreen-mode{
    overflow: hidden !important;
}
.note-editor.fullscreen{
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100% !important;
    height: 100% !important;
}
/* Summernote fullscreen proper fix */
.note-editor.note-frame.fullscreen {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    z-index: 999999 !important;
    background: #fff !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Editable area */
.note-editor.note-frame.fullscreen .note-editable {
    background: #fff !important;
    color: #000 !important;
    overflow-y: auto !important;
    padding: 20px !important;
}

/* Toolbar fix */
.note-editor.note-frame.fullscreen .note-toolbar {
    background: #fff !important;
    border-bottom: 1px solid #ddd !important;
}

/* Normal state mai sidebar sahi rahe */
.sidebar,
.main-sidebar,
.left-side,
aside{
    z-index: 999 !important;
}

/* Sirf fullscreen mode mai sidebar peeche chala jaye */
body:has(.note-editor.fullscreen) .sidebar,
body:has(.note-editor.fullscreen) .main-sidebar,
body:has(.note-editor.fullscreen) .left-side,
body:has(.note-editor.fullscreen) aside{
    z-index: 1 !important;
}
body:has(.note-editor.fullscreen) .sidebar{
    z-index: 0 !important;
}
</style>
<div class="container-fluid">
    <x-breadcrumb parent-label="Blog Posts" 
     :parent-route="route('admin.blog-posts.index')"
        current-page-title="Edit Blog Post" />

    <div class="card shadow-sm">
        <div class="card-body">

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.blog-posts.update', $post->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Post Name</label>
                        <input type="text" name="name" class="form-control @error('name') text-danger @enderror" value="{{ old('name', $post->name) }}">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Post Title</label>
                        <input type="text" name="title" class="form-control @error('title') text-danger @enderror" value="{{ old('title', $post->title) }}">
                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Read Time</label>
                        <input type="text" name="read_time" class="form-control"
                            value="{{ old('read_time', $post->read_time) }}" placeholder="5 min read">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Author Name</label>
                        <input type="text" name="author_name" class="form-control @error('author_name') text-danger @enderror"
                            value="{{ old('author_name', $post->author_name) }}">
                        @error('author_name')
                                <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Published Date</label>
                        <input type="date" name="published_date" class="form-control @error('published_date') text-danger @enderror"
                            value="{{ old('published_date', $post->published_date) }}">
                        @error('published_date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Badge Text</label>
                        <input type="text" name="badge_text" class="form-control @error('badge_text') text-danger @enderror"
                            value="{{ old('badge_text', $post->badge_text) }}" placeholder="Featured / Educational">
                        @error('badge_text')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Author Image (200 x 200)</label>
                        <input type="file" name="author_image" class="form-control" id="authorImageInput"
                            accept="image/*">

                        <div class="mt-2">
                            @if($post->author_image)
                            <img src="{{ asset($post->author_image) }}" id="authorImagePreview" class="img-thumbnail"
                                style="max-width: 100px;">
                            @else
                            <img id="authorImagePreview" class="img-thumbnail" style="max-width: 100px; display:none;">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        @error('categories')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="border rounded p-3" style="max-height: 280px; overflow-y: auto;">
                            @foreach($categories as $parent)
                            <div>
                                <label class="form-check-label fw-semibold border w-100 p-2 rounded-2 mb-2"
                                    for="cat_{{ $parent->id }}">
                                    <input class="form-check-input me-2" type="checkbox" name="categories[]"
                                        value="{{ $parent->id }}" id="cat_{{ $parent->id }}"
                                        {{ in_array($parent->id, old('categories', $selectedCategories)) ? 'checked' : '' }}>
                                    {{ $parent->name }}
                                </label>

                                @foreach($parent->children as $child)
                                <div class="ps-5 mb-2">
                                    <label class="form-check-label text-muted border w-100 p-2 rounded-2"
                                        for="cat_{{ $child->id }}">
                                        <input class="form-check-input me-2" type="checkbox" name="categories[]"
                                            value="{{ $child->id }}" id="cat_{{ $child->id }}"
                                            {{ in_array($child->id, old('categories', $selectedCategories)) ? 'checked' : '' }}>
                                        — {{ $child->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Featured Image (400 x 300)</label>
                        <input type="file" name="image" class="form-control" id="blogImageInput" accept="image/*">

                        <div class="mt-2">
                            @if($post->image)
                            <img src="{{ asset($post->image) }}" id="blogImagePreview" class="img-thumbnail"
                                style="max-width: 160px;">
                            @else
                            <img id="blogImagePreview" class="img-thumbnail" style="max-width: 160px; display:none;">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control"
                            rows="3">{{ old('short_description', $post->short_description) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Blog Content</label>
                        <textarea name="description"
                            class="form-control editor">{{ old('description', $post->description) }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Featured Read</label>
                        <select name="is_featured" class="form-select">
                            <option value="0" {{ old('is_featured', $post->is_featured) == 0 ? 'selected' : '' }}>No
                            </option>
                            <option value="1" {{ old('is_featured', $post->is_featured) == 1 ? 'selected' : '' }}>Yes
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Featured Article</label>
                        <select name="is_featured_article" class="form-select">
                            <option value="0"
                                {{ old('is_featured_article', $post->is_featured_article) == 0 ? 'selected' : '' }}>No
                            </option>
                            <option value="1"
                                {{ old('is_featured_article', $post->is_featured_article) == 1 ? 'selected' : '' }}>Yes
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="enable" {{ old('status', $post->status) == 'enable' ? 'selected' : '' }}>
                                Enable</option>
                            <option value="disable" {{ old('status', $post->status) == 'disable' ? 'selected' : '' }}>
                                Disable</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Blog FAQs</h5>
                            
                        </div>

                        <div id="faqWrapper">
                            @forelse($post->faqs as $faq)
                            <div class="faq-item border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">FAQ Question</label>
                                    <input type="text" name="faq_question[]" class="form-control"
                                        value="{{ $faq->question }}" placeholder="Enter FAQ question">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">FAQ Answer</label>
                                    <textarea name="faq_answer[]" class="form-control faq-editor" rows="4"
                                        placeholder="Enter FAQ answer">{!! $faq->answer !!}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="faq_sort_order[]" class="form-control"
                                            value="{{ $faq->sort_order }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="faq_status[]" class="form-select">
                                            <option value="enable" {{ $faq->status == 'enable' ? 'selected' : '' }}>
                                                Enable</option>
                                            <option value="disable" {{ $faq->status == 'disable' ? 'selected' : '' }}>
                                                Disable</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger btn-sm removeFaq">Remove</button>
                            </div>
                            @empty
                            <div class="faq-item border rounded p-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">FAQ Question</label>
                                    <input type="text" name="faq_question[]" class="form-control"
                                        placeholder="Enter FAQ question">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">FAQ Answer</label>
                                    <textarea name="faq_answer[]" class="form-control faq-editor" rows="4"
                                        placeholder="Enter FAQ answer"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="faq_sort_order[]" class="form-control" value="0">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="faq_status[]" class="form-select">
                                            <option value="enable">Enable</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger btn-sm removeFaq">Remove</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-success btn-sm" id="addFaq">+ Add FAQ</button>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-warning">Update Post</button>
                        <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('blogImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('blogImagePreview');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});

document.getElementById('authorImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('authorImagePreview');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
<script>
$(document).ready(function () {
    function initFaqEditor(selector) {
        $(selector).summernote({
            placeholder: 'Write FAQ answer here...',
            height: 180
        });
    }

    initFaqEditor('.faq-editor');

    $('#addFaq').on('click', function () {
        let uniqueId = 'faq_editor_' + Date.now();

        let html = `
            <div class="faq-item border rounded p-3 mb-3">
                <div class="mb-3">
                    <label class="form-label">FAQ Question</label>
                    <input type="text" name="faq_question[]" class="form-control" placeholder="Enter FAQ question">
                </div>

                <div class="mb-3">
                    <label class="form-label">FAQ Answer</label>
                    <textarea id="${uniqueId}" name="faq_answer[]" class="form-control" rows="4" placeholder="Enter FAQ answer"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="faq_sort_order[]" class="form-control" value="0">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="faq_status[]" class="form-select">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>
                </div>

                <button type="button" class="btn btn-danger btn-sm removeFaq">Remove</button>
            </div>
        `;

        $('#faqWrapper').append(html);
        initFaqEditor('#' + uniqueId);
    });

    $(document).on('click', '.removeFaq', function () {
        if ($('.faq-item').length > 1) {
            let item = $(this).closest('.faq-item');

            item.find('textarea').each(function () {
                if ($(this).next('.note-editor').length) {
                    $(this).summernote('destroy');
                }
            });

            item.remove();
        }
    });
});
</script>
@endpush