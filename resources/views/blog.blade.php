@extends('layouts.app')
@section('title', 'CouponNight Blog – Shopping Tips, Coupons & Saving Guides')
@section('meta_description', 'Read shopping guides, money-saving tips, coupon strategies, and online deal updates to help you save more before checkout.')

@section('content')

@php
    $featuredArticle = $featuredArticle ?? null;
    $featuredReads = $featuredReads ?? collect();
    $posts = $posts ?? collect();
    $categories = $categories ?? collect();

    $authors = $posts->pluck('author_name')->filter()->unique()->values();

    $sliderPosts = $featuredReads->count() ? $featuredReads : $posts->take(4);
    $sliderLoopPosts = $sliderPosts->concat($sliderPosts);
@endphp

<style>
.blog-hero-title {
    font-size: clamp(2.2rem, 5vw, 3.5rem);
}

.blog-featured-img,
.blog-card-img {
    aspect-ratio: 16 / 10;
    object-fit: cover;
}

.blog-search-wrap {
    position: relative;
}

.blog-search-input {
    padding-right: 46px;
    border-color: #EA580C;
}

.feild-border {
    border-color: #EA580C !important;
}

.blog-search-icon {
    position: absolute;
    top: 50%;
    right: 16px;
    transform: translateY(-50%);
    pointer-events: none;
}

.blog-badge {
    font-size: 10px;
    letter-spacing: .08em;
}

.blog-slider-wrap {
    overflow: hidden;
    position: relative;
    width: 100%;
}

.blog-slider-track {
    display: flex;
    gap: 1.5rem;
    width: max-content;
    animation: blogMarquee 28s linear infinite;
}

.blog-slider-wrap:hover .blog-slider-track {
    animation-play-state: paused;
}

.blog-slide-item {
    width: 320px;
    flex: 0 0 auto;
}
/* .dropdown-menu {
    overflow-y: scroll;
     max-height: 300px;
} */

.category-dropdown {
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;

    /* Firefox */
    scrollbar-width: none;

    /* IE and Edge */
    -ms-overflow-style: none;
}

/* Chrome, Safari */
.category-dropdown::-webkit-scrollbar {
    display: none;
}
@keyframes blogMarquee {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(calc(-50% - 0.75rem));
    }
}

@media (max-width: 767.98px) {
    .blog-slide-item {
        width: 280px;
    }

    .blog-slider-track {
        animation-duration: 22s;
    }
}
</style>

<section class="overflow-hidden">
    <div class="container pt-4 pt-lg-5 mb-bottom px-20">

  <!-- Hero -->
@if($featuredArticle)

<div class="row align-items-center g-4 g-lg-5 mb-bottom">

    <div class="col-lg-6">

        <!-- Badge Clickable -->
        <a href="{{ route('blog.detail', $featuredArticle->slug) }}"
           class="text-decoration-none">

            <span class="d-inline-block btn custom-btn small fw-medium mb-3">

                {{ $featuredArticle->badge_text ?? 'Featured Article' }}

            </span>

        </a>

        <!-- Title Clickable -->
        <a href="{{ route('blog.detail', $featuredArticle->slug) }}"
           class="text-decoration-none text-dark">

            <h1 class="fw-bold text-dark lh-1 mb-4 blog-hero-title">

                {{ $featuredArticle->name }}

            </h1>

        </a>

        <p class="text-dark mb-4 fs-6" style="text-align: justify;">

            {{ $featuredArticle->short_description ?? $featuredArticle->meta_description }}

        </p>

        <div class="d-flex align-items-center gap-3">

            @if($featuredArticle->author_image)

                <img src="{{ asset($featuredArticle->author_image) }}"
                     alt="{{ $featuredArticle->author_name ?? 'Author' }}"
                     class="rounded-circle flex-shrink-0 object-fit-cover"
                     width="48"
                     height="48">

            @endif

            <span class="fw-semibold text-dark">

                {{ $featuredArticle->author_name ?? 'Admin' }}

            </span>

        </div>

    </div>

    <!-- Image Clickable -->
    <div class="col-lg-6">

        <a href="{{ route('blog.detail', $featuredArticle->slug) }}"
           class="text-decoration-none">

            <div class="position-relative rounded-4 overflow-hidden shadow">

                @if($featuredArticle->image)

                    <img src="{{ asset($featuredArticle->image) }}"
                         alt="{{ $featuredArticle->title }}"
                         class="img-fluid w-100 blog-featured-img">

                @endif

                <span class="badge position-absolute top-0 end-0 mt-3 me-3 btn custom-btn px-3 py-2 rounded-2 fw-bold">

                    {{ strtoupper($featuredArticle->badge_text ?? 'Featured Article') }}

                </span>

            </div>

        </a>

    </div>

</div>

@endif

        <!-- Auto Slider -->
        @if($sliderPosts->count() > 0)
            <div class="mb-bottom d-none d-md-block">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold mb-0">Featured Reads</h3>
                </div>

                <div class="blog-slider-wrap">
                    <div class="blog-slider-track">
                        @foreach($sliderLoopPosts as $read)
                            <div class="blog-slide-item">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                    <div class="position-relative">
                                        @if($read->image)
                                            <a href="{{ route('blog.detail', $read->slug) }}">
                                                <img src="{{ asset($read->image) }}"
                                                    alt="{{ $read->title }}"
                                                    class="card-img-top blog-card-img">
                                            </a>
                                        @endif

                                        <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill text-uppercase fw-bold btn custom-btn blog-badge">
                                            {{ $read->badge_text ?? '' }}
                                        </span>
                                    </div>

                                    <div class="card-body p-4 d-flex flex-column">
                                        <h5 class="card-title fw-bold mb-3">
                                            {{ $read->name }}
                                        </h5>

                                        <p class="card-text text-muted flex-grow-1" style=" text-align: justify;">
                                            {{ \Illuminate\Support\Str::limit($read->short_description ?? $read->meta_description, 120) }}
                                        </p>

                                        <a href="{{ route('blog.detail', $read->slug) }}" class="text-dark text-decoration-none fw-bold small text-uppercase">
                                            Read More »
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Search -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="blog-search-wrap">
                    <input type="text" id="blogSearch" class="form-control rounded-pill px-4 py-2 blog-search-input shadow-none"
                        placeholder="Enter keywords">
                    <span class="blog-search-icon text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="d-flex flex-lg-row flex-md-row flex-sm-column flex-column justify-content-start mb-bottom gap-3">
            <div class="">
                <div class="dropdown w-100 w-md-auto">
                    <button class="btn feild-border rounded-pill px-4 py-2 text-start d-flex align-items-center justify-content-between w-100"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="dateFilterText">Sort By Date</span>
                        <span class="ms-3">▼</span>
                    </button>
                    <ul class="dropdown-menu rounded-4 shadow border-0 p-2 w-100">
                        <li><a class="dropdown-item rounded-3 py-2 date-filter" href="#" data-sort="latest">Newest First</a></li>
                        <li><a class="dropdown-item rounded-3 py-2 date-filter" href="#" data-sort="oldest">Oldest First</a></li>
                    </ul>
                </div>
            </div>

            <div class="">
                <div class="dropdown w-100 w-md-auto">
                    <button class="btn feild-border rounded-pill px-4 py-2 text-start d-flex align-items-center justify-content-between w-100"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="categoryFilterText">Categories</span>
                        <span class="ms-3">▼</span>
                    </button>
                    <ul class="dropdown-menu category-dropdown rounded-4 shadow border-0 p-2 w-100">
                        <li><a class="dropdown-item rounded-3 py-2 category-filter" href="#" data-category="all">All</a></li>

                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item rounded-3 py-2 category-filter text-wrap" href="#" data-category="{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                           
                     
                            @foreach($category->children as $child)
                                <li>
                                    <a class="dropdown-item rounded-3 py-2 category-filter text-wrap" href="#" data-category="{{ $child->id }}">
                                        — {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="">
                <div class="dropdown w-100 w-md-auto">
                    <button class="btn feild-border rounded-pill px-4 py-2 text-start d-flex align-items-center justify-content-between w-100"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="authorFilterText">Sort By Author</span>
                        <span class="ms-3">▼</span>
                    </button>
                    <ul class="dropdown-menu rounded-4 shadow border-0 p-2 w-100">
                        <li><a class="dropdown-item rounded-3 py-2 author-filter" href="#" data-author="all">All Authors</a></li>
                        <li><a class="dropdown-item rounded-3 py-2 author-sort" href="#" data-sort="author_az">Author A-Z</a></li>
                        <li><a class="dropdown-item rounded-3 py-2 author-sort" href="#" data-sort="author_za">Author Z-A</a></li>

                        @foreach($authors as $author)
                            <li>
                                <a class="dropdown-item rounded-3 py-2 author-filter" href="#" data-author="{{ strtolower($author) }}">
                                    {{ $author }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-4" id="blogGrid">
            @forelse($posts as $post)
                @php
                    $categoryIds = $post->categories->pluck('id')->implode(',');
                    $dateValue = $post->published_date
                        ? \Carbon\Carbon::parse($post->published_date)->timestamp
                        : $post->created_at->timestamp;
                @endphp

                <div class="col-lg-4 col-md-6 d-flex blog-item"
                    data-title="{{ strtolower($post->name) }}"
                    data-author="{{ strtolower($post->author_name ?? 'admin') }}"
                    data-category="{{ $categoryIds }}"
                    data-date="{{ $dateValue }}">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden w-100 h-100">
                        <div class="position-relative">
                            @if($post->image)
                            <a href="{{ route('blog.detail', $post->slug) }}">
                                <img src="{{ asset($post->image) }}"
                                    alt="{{ $post->name }}"
                                    class="card-img-top blog-card-img">
                                    </a>
                            @endif

                            <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill text-uppercase fw-bold btn custom-btn blog-badge">
                                {{ $post->badge_text ?? 'Article' }}
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-bold mb-3">
                                {{ $post->name }}
                            </h5>

                            <p class="card-text text-muted flex-grow-1" style=" text-align: justify;">
                                {{ \Illuminate\Support\Str::limit($post->short_description ?? $post->meta_description, 130) }}
                            </p>

                            <a href="{{ route('blog.detail', $post->slug) }}" class="text-dark text-decoration-none fw-bold small text-uppercase">
                                Read More »
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No blog posts found.
                    </div>
                </div>
            @endforelse
        </div>

        <div id="noResultBox" class="alert alert-info text-center mt-4 d-none">
            No blog posts found.
        </div>
<div class="mt-5">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const blogSearch = document.getElementById('blogSearch');
    const blogGrid = document.getElementById('blogGrid');
    const noResultBox = document.getElementById('noResultBox');

    const dateFilterText = document.getElementById('dateFilterText');
    const categoryFilterText = document.getElementById('categoryFilterText');
    const authorFilterText = document.getElementById('authorFilterText');

    let selectedCategory = 'all';
    let selectedAuthor = 'all';
    let selectedSort = 'latest';

    function getItems() {
        return Array.from(document.querySelectorAll('.blog-item'));
    }

    function applyFilters() {
        const searchValue = blogSearch.value.toLowerCase().trim();
        let items = getItems();

        items.forEach(function (item) {
            const title = item.dataset.title || '';
            const author = item.dataset.author || '';
            const categories = item.dataset.category ? item.dataset.category.split(',') : [];

            const searchMatch = title.includes(searchValue) || author.includes(searchValue);
            const categoryMatch = selectedCategory === 'all' || categories.includes(selectedCategory);
            const authorMatch = selectedAuthor === 'all' || author === selectedAuthor;

            if (searchMatch && categoryMatch && authorMatch) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });

        items.sort(function (a, b) {
            const dateA = parseInt(a.dataset.date || 0);
            const dateB = parseInt(b.dataset.date || 0);
            const authorA = a.dataset.author || '';
            const authorB = b.dataset.author || '';

            if (selectedSort === 'oldest') {
                return dateA - dateB;
            }

            if (selectedSort === 'author_az') {
                return authorA.localeCompare(authorB);
            }

            if (selectedSort === 'author_za') {
                return authorB.localeCompare(authorA);
            }

            return dateB - dateA;
        });

        items.forEach(function (item) {
            blogGrid.appendChild(item);
        });

        const visibleCount = getItems().filter(function (item) {
            return !item.classList.contains('d-none');
        }).length;

        if (visibleCount === 0) {
            noResultBox.classList.remove('d-none');
        } else {
            noResultBox.classList.add('d-none');
        }
    }

    document.querySelectorAll('.date-filter').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            selectedSort = this.dataset.sort;
            dateFilterText.textContent = this.textContent;
            applyFilters();
        });
    });

    document.querySelectorAll('.category-filter').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            selectedCategory = this.dataset.category;
            categoryFilterText.textContent = this.textContent;
            applyFilters();
        });
    });

    document.querySelectorAll('.author-filter').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            selectedAuthor = this.dataset.author;
            authorFilterText.textContent = this.textContent;
            applyFilters();
        });
    });

    document.querySelectorAll('.author-sort').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            selectedSort = this.dataset.sort;
            authorFilterText.textContent = this.textContent;
            applyFilters();
        });
    });

    blogSearch.addEventListener('keyup', applyFilters);

    applyFilters();
});
</script>

@endsection