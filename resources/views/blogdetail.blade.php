@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->meta_description)
@section('content')

@php
// dd($post);
$postDate = $post->published_date
? \Carbon\Carbon::parse($post->published_date)->format('F d, Y')
: $post->created_at->format('F d, Y');

$shareUrl = urlencode(request()->fullUrl());
$shareTitle = urlencode($post->title);
@endphp
<style>
.content-box p {
    text-align: justify;
}

.article-top-title {
    font-size: 20px;
}

.display-2 {
    font-size: 56px;
}
/* Small Deal Card */
.latest-product-card {
    /* max-width: 280px; */
    margin: 0 auto;
}

.latest-product-image img {
    height: 180px;
    object-fit: cover;
    width: 100%;
}

.latest-product-title {
    font-size: 16px;
    line-height: 1.3;
}

.latest-product-desc {
    font-size: 13px;
    line-height: 1.4;
    margin-bottom: 10px !important;
}

.latest-price {
    font-size: 18px;
    font-weight: 700;
}

.latest-old-price {
    font-size: 13px;
    text-decoration: line-through;
}

.latest-shop-btn {
    padding: 10px 15px !important;
    font-size: 14px;
}

.latest-discount-badge {
    font-size: 12px;
    padding: 5px 10px;
}

.latest-product-card .card-body {
    padding: 15px;
}
@media (max-width: 768px) {
    .article-top-title {
        font-size: 16px;
    }

    .display-2 {
        font-size: 30px;
    }
}
</style>
<div class="container px-20 mb-bottom">
    <div class="row px-2 px-lg-0">
        <div class="col-12 mt-5 mb-bottom">

            <div class=" d-flex flex-wrap align-items-center gap-3 mb-4 plusJakartaSans ">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark fw-bold "
                    style="font-size:18px;">Home</a>

                <div class="vr d-none d-sm-block"></div>

                <span class=" article-top-title col-lg-4 col-9 " style="color: #B71422; font-weight: 700; ">
                    {{ $post->name }}
                </span>
            </div>

            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-6 pt-4">
                    <h1 class="display-2  lh-1 mb-4 plusJakartaSans" style="font-weight: 700;">
                        {{ $post->name }}
                    </h1>

                    <p class=" mb-4 inter" style="font-size:18px; font-weight: 500; color:#595C5D; text-align:justify;">
                        {{ $post->short_description ?? $post->meta_description }}
                    </p>

                    <div class="d-flex flex-column gap-2 inter mb-3 mb-lg-0"
                        style="font-size:18px; font-weight: 500; color:#595C5D;">
                        <span>{{ $postDate }}</span>
                        <span>{{ $post->author_name ?? 'Admin' }}</span>
                        <span>{{ $post->badge_text ?? 'Article' }}</span>
                        <span>{{ $postDate }} @if($post->read_time) | {{ $post->read_time }} @endif</span>
                    </div>
                </div>

                <div class="col-lg-6 pe-0 text-center">
                    <div class=" p-0">
                        @if($post->image)
                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded-4"
                            style="height:350px;">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 tacos-page">
            <div class="row g-4">

                <div class="col-lg-4">
                    <div class="toc-box position-sticky ">
                        <div class="p-3 top-0 toc shadow mb-bottom">
                            <h5 class="fw-bold mb-3 plusJakartaSans " style="font-size:20px;">Table Of Contents</h5>
                            <hr class="mt-0 mb-3">

                            <ul class="list-unstyled mb-4" id="dynamicToc">
                                <li><a href="#article-content">Article Content</a></li>
                            </ul>
                        </div>

                        <div class="d-none d-lg-block mb-bottom">
                            <h4 class="fw-bold mb-3   plusJakartaSans"
                                style="font-size:24px; font-weight:700; color:black;">
                                Popular Categories
                            </h4>

                            <div class="d-flex flex-wrap gap-2 inter mb-bottom">
                                @forelse($categories as $category)

                                <a href="{{ route('coupon_category.page', $category->slug) }}"><span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white">
                                        {{ $category->name }}</a>
                                </span>
                                @empty
                                <span class="text-muted small">No categories found.</span>
                                @endforelse
                            </div>
                            @if($latestStore)

                            @php
                            $oldPrice = (float) preg_replace('/[^0-9.]/', '', $latestStore->old_price);
                            $currentPrice = (float) preg_replace('/[^0-9.]/', '', $latestStore->current_price);

                            $discount = 0;

                            if ($oldPrice > 0 && $currentPrice > 0) {
                            $discount = round((($oldPrice - $currentPrice) / $oldPrice) * 100);
                            }
                            @endphp

                            <div class=" mb-bottom" style="max-width: 300px;">

                                <!-- Deal Heading -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4 class="fw-bold mb-0 plusJakartaSans">
                                        Deal Of The Week
                                    </h4>

                                    @if($discount > 0)
                                    <span class="latest-discount-badge">
                                        -{{ $discount }}%
                                    </span>
                                    @endif
                                </div>

                                <div class="latest-product-card card border-0 overflow-hidden mb-bottom">
                                    <div class="latest-product-image p-0">

                                        @if($latestStore->image)
                                        <img src="{{ asset('public/uploads/products/' . $latestStore->image) }}"
                                            class="img-fluid" alt="{{ $latestStore->product_name }}">
                                        @endif

                                    </div>

                                    <div class="card-body text-center">
                                        <h4 class="fw-bold latest-product-title mb-2">
                                            {{ $latestStore->product_name }}
                                        </h4>
                                        <p class="latest-product-desc mb-3 fs-6">
                                            {{ Str::limit($latestStore->product_title, 65) }}
                                        </p>
                                        <div class="d-flex justify-content-center align-items-center gap-2 mb-4">

                                            <span class="latest-price">
                                                {{ $latestStore->current_price }}
                                            </span>

                                            @if($latestStore->old_price)
                                            <span class="latest-old-price">
                                                {{ $latestStore->old_price }}
                                            </span>
                                            @endif

                                        </div>

                                        <a href="{{ $latestStore->url }}" target="_blank"
                                            class="btn custom-btn rounded-pill px-4 py-3 w-100 latest-shop-btn">

                                            Shop Now
                                            <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>

                                    </div>

                                </div>

                            </div>

                            @endif
                        </div>

                        <div class="d-none d-lg-block mb-bottom">
                            <h5 class="fw-bold mt-4 mb-3 plusJakartaSans">Share This Article</h5>
                            <div class="d-flex gap-3 social-icons">
                                <a target="_blank"
                                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a target="_blank"
                                    href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 ps-lg-5 m-0">
                    <div class="content-box mb-bottom" id="article-content">
                        {!! $post->description !!}
                    </div>

                    @if(isset($popularPosts) && $popularPosts->count() > 0)
                    <div class="mt-5">
                        <h4 class="fw-bold mb-4 plusJakartaSans mt-5">Related Articles</h4>

                        <div class="row g-4">
                            @foreach($popularPosts as $popular)
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden w-100 h-100">
                                    <div class="position-relative">
                                        @if($popular->image)
                                        <a href="{{ route('blog.detail', $popular->slug) }}">
                                            <img src="{{ asset($popular->image) }}" alt="{{ $popular->title }}"
                                                class="card-img-top blog-card-img">
                                        </a>
                                        @endif

                                        <span
                                            class="badge position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill text-uppercase fw-bold btn custom-btn blog-badge">
                                            {{ $popular->badge_text ?? 'Article' }}
                                        </span>
                                    </div>

                                    <div class="card-body d-flex flex-column p-4">
                                        <h5 class="card-title fw-bold mb-3">
                                            {{ $popular->name ?? '' }}
                                        </h5>

                                        <p class="card-text text-muted flex-grow-1">
                                            {{ \Illuminate\Support\Str::limit($popular->short_description ?? $popular->meta_description, 100) }}
                                        </p>

                                        <a href="{{ route('blog.detail', $popular->slug) }}"
                                            class="text-dark text-decoration-none fw-bold small text-uppercase">
                                            Read More »
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                <div class="d-block d-lg-none m-0">
                    <div>
                        <h4 class="fw-bold   plusJakartaSans"
                            style="font-size:24px; font-weight:700; color:black;">
                            Popular Categories
                    </h4>

                        <div class="d-flex flex-wrap gap-2 inter mb-bottom">
                            @forelse($categories as $category)
                            <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white">
                                {{ $category->name }}
                            </span>
                            @empty
                            <span class="text-muted small">No categories found.</span>
                            @endforelse
                        </div>
                   @if($latestStore)

                            @php
                            $oldPrice = (float) preg_replace('/[^0-9.]/', '', $latestStore->old_price);
                            $currentPrice = (float) preg_replace('/[^0-9.]/', '', $latestStore->current_price);

                            $discount = 0;

                            if ($oldPrice > 0 && $currentPrice > 0) {
                            $discount = round((($oldPrice - $currentPrice) / $oldPrice) * 100);
                            }
                            @endphp

                            <div class=" mb-bottom">

                                <!-- Deal Heading -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4 class="fw-bold mb-0 plusJakartaSans">
                                        Deal Of The Week
                                    </h4>

                                    @if($discount > 0)
                                    <span class="latest-discount-badge">
                                        -{{ $discount }}%
                                    </span>
                                    @endif
                                </div>

                                <div class="latest-product-card card border-0 overflow-hidden mb-bottom">
                                    <div class="latest-product-image">

                                        @if($latestStore->image)
                                        <img src="{{ asset('public/uploads/products/' . $latestStore->image) }}"
                                            class="img-fluid" alt="{{ $latestStore->product_name }}">
                                        @endif

                                    </div>

                                    <div class="card-body text-center">
                                        <h4 class="fw-bold latest-product-title mb-2">
                                            {{ $latestStore->product_name }}
                                        </h4>
                                        <p class="latest-product-desc mb-3">
                                            {{ Str::limit($latestStore->product_title, 65) }}
                                        </p>
                                        <div class="d-flex justify-content-center align-items-center gap-2 mb-4">

                                            <span class="latest-price">
                                                {{ $latestStore->current_price }}
                                            </span>

                                            @if($latestStore->old_price)
                                            <span class="latest-old-price">
                                                {{ $latestStore->old_price }}
                                            </span>
                                            @endif

                                        </div>

                                        <a href="{{ $latestStore->url }}" target="_blank"
                                            class="btn custom-btn rounded-pill px-4 py-3 w-100 latest-shop-btn">

                                            Shop Now
                                            <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>

                                    </div>

                                </div>

                            </div>

                            @endif
                    </div>

                    <div class="mb-bottom">
                        <h5 class="fw-bold mt-4 mb-0 mb-lg-3 plusJakartaSans">Share This Article</h5>
                        <div class="d-flex gap-3 social-icons">
                            <a target="_blank"
                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a target="_blank"
                                href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 mt-lg-5 pt-lg-3 m-0">

                    @if($post->faqs && $post->faqs->count() > 0)
                    <div class="blog-faq-section mt-1">
                        <h3 class="fw-bold mb-4 plusJakartaSans">Frequently Asked Questions</h3>

                        <div class="accordion" id="blogFaqAccordion">
                            @foreach($post->faqs as $faq)
                            <div class="accordion-item mb-3  rounded-3 overflow-hidden"
                                style="border:1px solid #ffaa03">
                                <h2 class="accordion-header fw-bold" id="blogFaqHeading{{ $faq->id }}">
                                    <button
                                        class="accordion-button bg-white shadow-none {{ !$loop->first ? 'collapsed' : '' }}"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#blogFaqCollapse{{ $faq->id }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="blogFaqCollapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>

                                <div id="blogFaqCollapse{{ $faq->id }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="blogFaqHeading{{ $faq->id }}" data-bs-parent="#blogFaqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const contentBox = document.querySelector('.content-box');
    const tocList = document.getElementById('dynamicToc');

    if (!contentBox || !tocList) return;

    // Sirf direct H2 & H3 headings
    const headings = contentBox.querySelectorAll('h2, h3');

    if (!headings.length) {
        tocList.innerHTML = '<li><a href="#article-content">Article Content</a></li>';
        return;
    }

    let tocHtml = '';
    let usedIds = [];

    headings.forEach(function(heading, index) {

        // ⚠️ skip agar andar unwanted tags hain (extra safety)
        if (heading.querySelector('p')) return;

        let text = heading.innerText.trim();
        if (!text) return;

        // simple unique id (text based nahi)
        let id = 'toc-heading-' + index;

        // duplicate avoid
        if (usedIds.includes(id)) {
            id = id + '-' + Math.floor(Math.random() * 1000);
        }

        usedIds.push(id);
        heading.setAttribute('id', id);

        // short text
        let shortText = text.length > 35 ? text.substring(0, 35) + '...' : text;

        // H3 indent
        let extraClass = heading.tagName.toLowerCase() === 'h3' ? 'ps-3' : '';

        tocHtml += `
                        <li class="${extraClass}">
                            <a href="#${id}">${shortText}</a>
                        </li>
                    `;
    });

    tocList.innerHTML = tocHtml;

});
</script>

@endsection