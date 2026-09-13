@extends('layouts.app')

@section('title', 'Product Deals, Discounts & Online Offers')
@section('meta_description', 'Browse trending product deals, online discounts, and verified shopping offers across fashion, electronics, beauty, home essentials, and more.')

@section('content')
<style>
.product-img{
    height: 220px;
    
}

@media (max-width: 768px){

    .card{
        border-radius: 16px !important;
    }

    .product-img{
        height: 140px;
    }

    .card-body{
        padding: 12px !important;
    }

    .card-body h5{
        font-size: 14px !important;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 40px;
        margin-bottom: 10px !important;
    }

    .card-body small{
        font-size: 10px !important;
    }

    .card-body .fs-4{
        font-size: 16px !important;
    }

    .feature-btn{
        padding: 8px !important;
        font-size: 13px;
    }

    .badge{
        font-size: 10px;
    }
}
@media (max-width: 991px) {
    .main-content { order: 1; }
    .sidebar-content { order: 2; }
}
</style>
<div class="container px-20 ">
    <div class="row " >

        <div class="container mb-bottom mt-3">
            <div class="border rounded-4 bg-light px-3 px-md-4 py-3 py-md-4">
                <h2 class="fw-bold mb-2" style="font-size: 20px;">
                    Best Deals From Trending Stores 2026
                </h2>

                <p class="mb-0 text-secondary" style="font-size: 14px; line-height: 1.7; text-align: justify;">
                    Review in detail the latest offerings we have on our deals page. Each listing highlights the most
                    favorable price, the current price discounted, and the potential savings on products across the
                    fashion, home decor, beauty, electronics, and other shopping categories on our platform. With a
                    simple click, access these deals, fully authorized by merchants, and available without delay.
                </p>
            </div>
        </div>

        <!-- Left Side -->
        <div class="col-lg-3 col-md-4 col-12 sidebar-content">
            <div class="bg-white border rounded-4 p-4 mb-bottom shadow-sm products">
                <h4 class="fw-bold mb-3 plusJakartaSans">Explore More Brands</h4>

                <ul class="list-unstyled mb-0 small inter">
                    @foreach ($stores as $store)
                        <li class="mb-2"><a href="{{ route('front.product', ['store' => $store->slug]) }}" class="text-decoration-none text-dark"><i class="fa-solid fa-chevron-right"></i> {{ $store->name ?? ''}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-bottom">
                <h4 class="fw-bold mb-3 plusJakartaSans">Popular Categories</h4>

                <div class="d-flex flex-wrap gap-2 inter">
                    @foreach ($categories as $category)
                        <a href="{{ route('front.product', ['category' => $category->slug]) }}" class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white text-decoration-none">{{$category->name ?? ''}}</a>
                    @endforeach
                </div>
            </div>

            @if ($letestStores->count() > 0)
            <div class="mb-bottom mb-bottom">
                <h4 class="fw-bold mb-3 plusJakartaSans">Related Stores</h4>

                <div class="row g-3 inter">
                    @foreach($letestStores as $letestStore)
                        <div class="col-6">
                            <a href="{{ route('front.product', ['store' => $letestStore->slug]) }}" class="text-decoration-none">
                                <div class="bg-white border rounded-4 shadow-sm text-center p-4 h-100">
                                    <img src="{{ asset('public/uploads/stores/'.$letestStore->logo ?? '') }}" alt="" class="img-fluid rounded-2 " >
                                    
                                   
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Side -->
        <div class="col-lg-9 col-md-8 col-12 mb-bottom main-content">
            <div class="mb-4">
    <div class="position-relative">
        <input
            type="text"
            id="productSearch"
            class="form-control rounded-pill px-4 py-2
             shadow-sm"
            placeholder="Search products, stores...">

        <i class="fa-solid fa-magnifying-glass position-absolute"
           style="right:20px; top:50%; transform:translateY(-50%); color:#999;">
        </i>
    </div>
</div>
            <div class="row g-4" id="productsContainer">

                @forelse($products as $product)
                
                    <div class="col-xl-4 col-lg-4 col-md-6 col-6 p-1 p-lg-2">

                        @php

                            $oldPrice = (float) preg_replace('/[^0-9.]/', '', $product->old_price ?? 0);
                            $currentPrice = (float) preg_replace('/[^0-9.]/', '', $product->current_price ?? 0);

                            $discount = 0;

                            if ($oldPrice > 0 && $currentPrice > 0) {
                                $discount = round((($oldPrice - $currentPrice) / $oldPrice) * 100);
                            }

                        @endphp

                        <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">

                            <div class="position-relative">

                                <img src="{{ asset('public/uploads/products/'.$product->image ?? '') }}"
                                    class="card-img-top w-100 product-img"
                                    alt="Product">

                                @if($discount > 0)
                                    <span class="badge btn custom-btn rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white">
                                        {{ $discount }}%
                                    </span>
                                @endif

                            </div>

                            <div class="card-body d-flex flex-column p-3">

                                <small class="link fw-bold text-uppercase mb-2" style="font-size: 10px;">
                                    {{ $product->store->name }}
                                </small>

                                <h5 class="fw-bold mb-3" style="font-size: 16px;">
                                    {{ $product->product_name }}
                                </h5>

                                <div class="mb-4">

                                    <span class="fw-bold fs-4 me-2" style="font-size: 19px;">
                                        {{ $product->current_price }}
                                    </span>

                                    @if($oldPrice > 0)
                                        <span class="text-secondary text-decoration-line-through">
                                            {{ $product->old_price }}
                                        </span>
                                    @endif

                                </div>

                                <a href="{{ $product->url ?? '' }}"
                                    class="btn custom-btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                    Get Deal <i class="fa-solid fa-arrow-right ms-2 "></i>
                                </a>

                            </div>

                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="mb-0 text-muted">Product Not Found</p>
                    </div>
                @endforelse

            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection
@push('scripts')
<script>

let timer;

$('#productSearch').on('keyup', function () {

    clearTimeout(timer);

    let search = $(this).val();

    timer = setTimeout(function () {

        $.ajax({
            url: "{{ url('/search-products') }}",
            type: "GET",
            data: {
                search: search
            },
            success: function (products) {

                let html = '';

                products.forEach(function (product) {

                    html += `
                    <div class="col-xl-4 col-lg-4 col-md-6 col-6 p-1 p-lg-2">
                        <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">

                            <img src="/public/uploads/products/${product.image}"
                                 class="card-img-top product-img">

                            <div class="card-body">
                                <small class="fw-bold text-uppercase">
                                    ${product.store.name}
                                </small>

                                <h5 class="fw-bold mt-2">
                                    ${product.product_name}
                                </h5>

                                <div class="mb-3">
                                    <span class="fw-bold fs-5">
                                        ${product.current_price}
                                    </span>
                                </div>

                                <a href="${product.url}"
                                   class="btn custom-btn text-white rounded-pill w-100">
                                    Get Deal
                                </a>
                            </div>

                        </div>
                    </div>`;
                });

                $('#productsContainer').html(html);

            }
        });

    }, 300);

});

</script>

@endpush