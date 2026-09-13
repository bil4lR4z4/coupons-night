@extends('layouts.app')

@section('title', $category->title)
@section('meta_description', $category->description)
@section('content')

<style>
    .coupon-title{
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.coupon-logo{
    width:70px;
    height:70px;
    object-fit:contain;
}

.coupon-title{
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
    line-height:1.6;
   
}

.verify-icon{
    width:80px;
}


.dealbutton{
    min-width: 150px; /* zarurat ho to 180px kar dein */
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;

    white-space: nowrap;
    overflow: hidden;
}

.dealbutton i{
   
    flex-shrink: 0;
}
@media (max-width:576px){

    .row-cols-2>.col{
        padding-left:8px;
        padding-right:8px;
    }

    .card-body{
        padding:20px !important;
    }

    .coupon-logo{
        width:65px;
        height:65px;
    }

    .coupon-title{
        font-size:16px;
        min-height:70px;
    }
.dealbutton{
    min-width: 100px !important;
    margin-top: 20px !important;
}
}
@media (max-width: 991px) {
    .main-content { order: 1; }
    .sidebar-content { order: 2; }
    .dealbutton{
    min-width: 100px !important;
    margin-top: 20px !important;
}
}
</style>
<div class="container mt-3  px-20">
    <div class="row ">

        <div class="container mb-bottom">
            <div class="border rounded-4 bg-light p-3 p-md-4">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-4">
                    <div class="flex-shrink-0">
                        @if (!empty($category->image) && file_exists(public_path('uploads/categories/' . $category->image)))
                        <img 
                            src="{{ asset('uploads/categories/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="rounded-circle border shadow-sm"
                            style="
                                width: 100px;
                                height: 100px;
                                object-fit: cover;
                            "
                        >
                        @else
                            <div 
                                class="rounded-circle border shadow-sm d-flex align-items-center justify-content-center fw-bold text-uppercase bg-dark text-white"
                                style="
                                    width: 100px;
                                    height: 100px;
                                    font-size: 28px;
                                "
                            >
                                {{ strtoupper(substr($category->name, 0, 2)) }}
                            </div> 
                        @endif
                    </div>

                    <div class="flex-grow-1 text-center text-md-start">

                        <h2 class="fw-bold mb-3">
                            {{ $category->name }}
                        </h2>

                        <p class="text-secondary mb-0"
                        style="
                                font-size: 15px;
                                line-height: 1.8;
                        ">
                            {{ $category->description }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <!-- Left Side -->
        <div class="col-lg-3 col-md-4 col-12 sidebar-content">
            <div class="bg-white border rounded-4 p-4  shadow-sm products mb-bottom">
                <h4 class="fw-bold mb-3 plusJakartaSans">Explore More Brands</h4>

                <ul class="list-unstyled mb-0 small inter ">
                    @foreach($brands as $brand)
                    <li class="mb-2">
                        <a href="{{ route('store.show', $brand->slug) }}" class="text-decoration-none text-dark">
                            &gt; {{ $brand->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class=" mb-bottom">
                <h4 class="fw-bold mb-3 plusJakartaSans ">Popular Categories</h4>

                <div class="d-flex flex-wrap gap-2 inter">
                    @foreach($popularCategories as $cat)
                        <a href="{{ route('coupon_category.page', $cat->slug) }}"
                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white text-decoration-none">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mb-bottom">
                <h4 class="fw-bold mb-3 plusJakartaSans">Related Stores</h4>

                <div class="row  g-2 inter">
                    @foreach($relatedStores as $store)
                        <div class="col-6">
                            <a href="{{ route('store.show', $store->slug) }}" class="text-decoration-none text-dark">
                                <div class="bg-white border rounded-4 shadow-sm text-center p-4 h-100">
                                    @if($store->logo)
                                        <img src="{{ asset('uploads/stores/'.$store->logo) }}"
                                            class="img-fluid rounded-2 ">
                                    @endif

                                    <!-- <div class="fw-semibold" style="font-size: 12px;">
                                        {{ $store->name }}
                                    </div> -->
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

<!-- Right Side -->
<div class="col-lg-9 col-md-8 col-12 mb-bottom main-content">

        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-2 g-lg-4 g-md-4 g-sm-3 g-3">
            @foreach($coupons as $coupon)
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div
                        class="card-body d-flex flex-lg-row flex-md-column flex-sm-column flex-column  justify-content-between align-items-lg-center align-items-md-start align-items-sm-start align-items-start p-lg-3 p-md-3 p-3">
                        <div
                            class="d-flex flex-lg-row flex-md-row flex-sm-row flex-column gap-3 align-items-lg-center align-items-md-center align-items-sm-center align-items-start">
                            <a href="{{ $coupon->store->store_url ?? '#' }}" class="text-decoration-none text-dark">
                                <div class="ratio ratio-1x1" style="width:54px; height:54px">
                                    <img src="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
                                        alt="{{ $coupon->store->name ?? '' }}" class="rounded object-fit-cover">
                                </div>
                            </a>

                            <div>

                                <h6 class="mb-1">
                                    {{ $coupon->name ?? '' }}
                                </h6>

                                <a href="{{ $coupon->store->store_url ?? '#' }}" class="text-decoration-none text-dark">
                                    <p class="smaller m-0">
                                        {{ $coupon->store->name ?? '' }}
                                        <img src="{{ asset('images/icons/check-verify-second.svg') }}" alt="Verified">
                                    </p>
                                </a>
                            </div>
                        </div>

                        <div>
                            <button class="btn px-3 custom-btn dealbutton rounded-pill get-code-btn"
                                  class="btn px-3 custom-btn rounded-pill get-code-btn"
   data-name="{{ $coupon->name ?? '' }}"
   data-image="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
   data-code="{{ $coupon->coupon_code ?? '' }}"
   data-type="{{ $coupon->is_no_code ? 'deal' : 'code' }}"
   data-link="{{ $store->store_url ?? '' }}">
    {{ $coupon->is_no_code ? 'Get Deal' : 'Get Code' }}
    <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
<div class="mt-5">
    {{ $coupons->links('pagination::bootstrap-5') }}
</div>
</div>
    </div>

</div>


@endsection