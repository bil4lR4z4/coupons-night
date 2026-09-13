@if($marques->count() > 0)
<div class="border-bottom site-header">
    <marquee behavior="scroll" direction="left" class="py-2">
        @foreach ($marques as $marque)
        {{ strip_tags($marque->name) }} &nbsp;&nbsp;&nbsp;
        @endforeach
    </marquee>
</div>
@endif
<header>
    <div class="container-fluid site-header  py-3">
        <div class="container">
            <div class="row row-gap-3">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 order-md-1 order-sm-1 order-1">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset($setting->site_logo ?? '') }}" alt="" style="width:150px">
                    </a>
                </div>
                <div
                    class="col-lg-6 col-md-12 order-lg-2 order-md-3 order-sm-3 order-3 d-lg-block d-md-block d-sm-block d-none gap-3 position-relative searchBox">
                    
                    <form action="{{ route('search.store') }}" method="get" autocomplete="off">
                        <div class="input-group overflow-hidden rounded-pill border bg-light bg-opacity-25">

                            <button type="submit" class="input-group-text bg-transparent border-0">
                                <i class="fa-solid fa-magnifying-glass text-light"></i>
                            </button>

                            <input 
                                type="text" 
                                name="search"
                                class="form-control bg-transparent border-0 text-light shadow-none storeSearch"
                                placeholder="Search for stores..."
                            >
                        </div>
                    </form>
                    <div 
                        class="searchResults position-absolute top-100 start-0 w-100 bg-white rounded-3 mt-1 shadow d-none overflow-hidden" style="z-index:9999999">
                    </div>

                </div>
                <div
                    class="col-lg-3 d-flex gap-3 justify-content-end align-items-center col-md-6 col-sm-6 col-6 order-lg-3 order-md-2 order-sm-2 order-2">
                    <a href="{{route('exclusive.page')}}"
                        class="btn px-4 custom-btn btn-theme rounded-pill d-lg-block d-md-block d-sm-block d-none text-nowrap">Exclusive
                        Discounts</a>
                    <button type="button" class="btn custom-btn d-lg-none d-md-none d-sm-none d-block"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa-solid fa-magnifying-glass text-light"></i>
                    </button>
                    <button class="btn custom-btn d-lg-none d-block " type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg d-lg-block d-none">
        <div class="container">

            <div class="collapse navbar-collapse justify-content-center " id="navbarSupportedContent">
                <ul class="navbar-nav gap-lg-5 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home page</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('categories.page') }}" aria-expanded="false">
                            Categories<i class="fa-solid fa-angle-down ms-2"></i>
                        </a>
                        @if($categories->count() > 0)
                        <div class="dropdown-menu mega-menu p-4 border-0 shadow rounded-1 mt-0 categoryDropdowne">
                            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1">
                                @foreach ($categories as $category)
                                <div class="col">
                                    <a href="{{ route('coupon_category.page', $category->slug) }}"
                                        class="store-link d-block text-decoration-none">
                                        {{ $category->name }}
                                    </a>
                                </div>
                                @endforeach
                                <div class="col">
                                    <a href="{{ route('categories.page') }}"
                                        class="store-link d-block text-decoration-none link">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('front.product') }}" aria-expanded="false">
                            Products
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('stores.page') }}" role="button">
                            Stores<i class="fa-solid fa-angle-down ms-2"></i>
                        </a>
                        @if($stores->count() > 0)
                        <div class="dropdown-menu mega-menu p-4 border-0 shadow rounded-1 mt-0 storeDropdown">
                            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1">
                                @foreach ($stores as $store)
                                <div class="col">
                                    <a href="{{ route('store.show', $store->slug) }}"
                                        class="store-link d-block text-decoration-none">
                                        {{ $store->name }}
                                    </a>
                                </div>
                                @endforeach
                                <div class="col">
                                    <a href="{{ route('stores.page') }}"
                                        class="store-link d-block text-decoration-none link">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('all-events') }}" role="button" aria-expanded="false">
                            Events<i class="fa-solid fa-angle-down ms-2"></i>
                        </a>
                        @if($events->count() > 0)
                        <div class="dropdown-menu dropdown-menu-end mega-menu p-4 border-0 shadow rounded-1 mt-0">
                            <div class="row row-cols-lg-1 row-cols-md-1 row-cols-1">
                                @foreach ($events as $event)
                                <div class="col">
                                    <a href="{{ route('event.page', $event->slug) }}"
                                        class="store-link d-block text-decoration-none">
                                        {{ $event->name }}
                                    </a>
                                </div>
                                @endforeach
                                <div class="col">
                                    <a href="{{ route('all-events') }}"
                                        class="store-link d-block text-decoration-none link">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('blog')}}" role="button">
                            Blog <i class="fa-solid fa-angle-down ms-2"></i>
                        </a>
                        @if($blogCategories->count() > 0)
                        <div
                            class="dropdown-menu dropdown-menu-end mega-menu p-3 shadow border-0 rounded-1 mt-0 blogDropdown">
                            <div class="row">
                                <div class="col-4 border-end border-4">
                                    @foreach ($blogCategories as $key => $category)
                                    <div class="blog-category mb-2 {{ $key == 0 ? 'active' : '' }}"
                                        data-id="{{ $category->id }}" style="cursor:pointer;">
                                        {{ $category->name }}
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-8">
                                    @foreach ($blogCategories as $key => $category)
                                    <div class="blog-list" id="blog-{{ $category->id }}"
                                        style="{{ $key != 0 ? 'display:none;' : '' }}">
                                        @foreach ($category->blogPosts as $blog)
                                        <div class="mb-2">
                                            <a href="{{ route('blog.detail', $blog->slug) }}"
                                                class="text-decoration-none text-dark fw-semibold link">
                                                {{ \Illuminate\Support\Str::limit($blog->name, 50) }}
                                            </a>
                                        </div>
                                        @endforeach
                                        <div class="mb-2">
                                            <a href="{{route('blog')}}"
                                                class="text-decoration-none fw-semibold link">
                                                View All
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">
                <a href="{{ route('home') }}">
                    <img src="{{ asset($setting->site_logo ?? '') }}" alt="" style="width:150px;">
                </a>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column gap-3">
            <a href="/" class="text-decoration-none text-dark nav-link">Home Page</a>
            <a href="{{ route('front.product') }}" class="text-decoration-none text-dark nav-link">Products</a>
            <div class="accordion accordion-flush d-flex flex-column gap-3" id="accordionExample">
                <div class="accordion-item border-0">
                    <h2 class="accordion-header bg-transprent">
                        <button class="accordion-button bg-transparent collapsed p-0 shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false"
                            aria-controls="collapseCategories">
                            Categories
                        </button>
                    </h2>
                    <div id="collapseCategories" class="accordion-collapse collapse mt-2"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex flex-column gap-2 p-0">
                            @foreach ($categories as $category)
                            <a href="{{ route('coupon_category.page', $category->slug) }}"
                                class="text-dark text-decoration-none">
                                {{ $category->name }}
                            </a>
                            @endforeach

                            <a href="{{ route('categories.page') }}" class="text-decoration-none link">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header bg-transprent">
                        <button class="accordion-button bg-transparent collapsed p-0 shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseStore" aria-expanded="false"
                            aria-controls="collapseStore">
                            Stores
                        </button>
                    </h2>
                    <div id="collapseStore" class="accordion-collapse collapse mt-2" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex flex-column gap-2 p-0">
                            @foreach ($stores as $store)
                            <a href="{{ route('store.show', $store->slug) }}"
                                class="text-dark d-block text-decoration-none">
                                {{ $store->name }}
                            </a>
                            @endforeach
                            <a href="{{ route('stores.page') }}"
                                class="link text-decoration-none">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header bg-transprent">
                        <button class="accordion-button bg-transparent collapsed p-0 shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseEvent" aria-expanded="false"
                            aria-controls="collapseEvent">
                            Events
                        </button>
                    </h2>
                    <div id="collapseEvent" class="accordion-collapse collapse mt-2" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex flex-column gap-2 p-0">
                            @foreach ($events as $event)
                            <a href="{{ route('event.page', $event->slug) }}" class="text-dark text-decoration-none">
                                {{ $event->name }}
                            </a>
                            @endforeach
                            <a href="{{ route('all-events') }}"
                                class="link text-decoration-none">
                                View All
                            </a>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0">
                    <h2 class="accordion-header bg-transprent">
                        <button class="accordion-button bg-transparent collapsed p-0 shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseBlog" aria-expanded="false"
                            aria-controls="collapseEvent">
                            Blogs
                        </button>
                    </h2>
                    <div id="collapseBlog" class="accordion-collapse collapse mt-2" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex flex-column gap-2 p-0">
                            <div class="accordion border-0" id="accordionBlogChild">
                                @foreach ($blogCategories as $key => $category)
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button
                                            class="btn w-100 border-0 px-0 d-flex justify-content-between align-items-center collapsed"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$category->id}}" aria-expanded="false"
                                            aria-controls="collapse{{$category->id}}">

                                            {{ $category->name }}

                                            <i class="fa fa-plus accordion-icon"></i>
                                        </button>
                                    </h2>
                                    <div id="collapse{{$category->id}}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionBlogChild">
                                        <div class="accordion-body p-0">
                                            @foreach ($category->blogPosts as $blog)
                                            <div class="mb-2">
                                                <a href="{{ route('blog.detail', $blog->slug) }}"
                                                    class="text-decoration-none text-dark fw-semibold link">
                                                    {{ \Illuminate\Support\Str::limit($blog->name, 50) }}
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <a href="{{route('blog')}}"
                                    class="link text-decoration-none">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <a href="{{ route('contact') }}" class="text-decoration-none text-dark nav-link">Contact Us</a>
        </div>
    </div>
<style>
    .mobailSearchModel .modal-body a {
        color: #fff !important ;
    }
    .mobailSearchModel .modal-body a small{
        color: #f0f0f0 !important ;
    }
    .mobailSearchModel .modal-body .text-dark{
        color: #f0f0f0 !important ;
    }
</style>
    <div class="modal bg-dark bg-opacity-75 fade mobailSearchModel" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-theme="dark"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center">
                    <div class="position-relative searchBox">
                    <form action="{{ route('search.store') }}" method="get" autocomplete="off">
                        <div class="input-group rounded-pill border bg-light bg-opacity-25">
                            <button class="btn custom-btn border-0 rounded-start-pill"><i
                                    class="fa-solid fa-magnifying-glass text-light"></i></button>
                            <input type="text" name="serch" class="form-control bg-transparent border-0 text-light shadow-none storeSearch"
                                placeholder="Search for stores..." >
                        </div>
                    </form>
                    <div 
                        class="searchResults position-absolute start-0 w-100 bg-white bg-opacity-25 text-light rounded-3 mt-1 shadow d-none overflow-hidden" style="z-index:9999999">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
@media (max-width: 480px) {
    header img {
        width: 120px !important;
    }

    header #upcoming-event {
        font-size: 12px !important;
        padding: 5px 10px !important;
    }
}
.accordion button[aria-expanded="true"] .accordion-icon::before{
    content: "\f068";
}

.accordion-icon{
    font-size:14px;
}
header input::placeholder {
    color: #FFFFFF !important;
}

.mega-menu {
    width: 500px;
    /* left: 50%;
        transform: translateX(-50%); */
    border-radius: 10px;
}

.store-link {
    padding: 10px 15px;
    border-radius: 8px;
    /* color: #000; */
    transition: 0.3s;
}
.store-link:not(.link) {
    color: #000;
}

@media (max-width: 576px) {
    .mega-menu {
        width: 100% !important;
    }
}

header .nav-item.dropdown:hover .mega-menu {
    display: block;
    margin-top: 0;
    opacity: 1;
    visibility: visible;
}

.mega-menu {
    display: none;
    transition: all 0.2s ease;
}

.blogDropdown {
    right: 0% !important;
}
</style>