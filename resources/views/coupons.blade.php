@extends('layouts.app')

@section('title', 'Coupon Categories – Browse Deals & Discount Offers')
@section('meta_description', 'Explore coupon categories for fashion, electronics, beauty, food, travel, and more. Find
verified promo codes and online deals updated daily.')

@section('content')
<style>
    .pagination .page-link {
    color: #25105a;
    border-color: #dee2e6;
    box-shadow: none !important;
}

.pagination .page-link:hover {
    color: #fff;
    background: linear-gradient(90deg, #161b22 0%, #25105a 100%);
    border-color: #25105a;
}

.pagination .page-item.active .page-link {
    color: #fff;
    background: linear-gradient(90deg, #161b22 0%, #25105a 100%);
    border-color: #25105a;
}

.pagination .page-link:focus {
    box-shadow: none;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
}

.help-search-box{
    max-width:700px;
    margin:auto;
}

.help-search-box input{
    height:55px;
    border-radius:12px;
    padding-left:20px;
    border:1px solid #ddd;
    box-shadow:none !important;
}


</style>
<div class="site-header text-white text-center py-4 py-md-5 mb-bottom">
    <div class="container">
        <small class="d-block mb-1">Browse Coupons</small>
        <h2 class="fw-bold mb-0">All Coupons</h2>
     
<div class="help-search-box mt-4">

    <form method="GET">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by store..."
            value="{{ request('search') }}">

    </form>

</div>


    </div>
</div>

<div class="container mb-bottom px-20">


{{-- Small category boxes --}}
<div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-2 row-gap-4">

    @forelse($coupons as $coupon)

    @php
    if($coupon->is_no_code == 1){
        $type = "deal";
        $btnText = "Get Deal";
        $code = "";
    }elseif($coupon->is_no_code == 0){
        $type = "code";
        $btnText = "Get Code";
        $code = $coupon->coupon_code ?? '';
    }
    @endphp

    <div class="">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body d-flex flex-lg-row flex-md-column flex-sm-column flex-column gap-3 justify-content-between align-items-lg-center align-items-md-start align-items-sm-start align-items-start p-lg-4 p-md-4 p-3">

                <div class="d-flex flex-lg-row flex-md-row flex-sm-row flex-column gap-3 align-items-lg-center align-items-md-center align-items-sm-center align-items-start">

                    <a href="{{ $coupon->store->store_url ?? '#' }}"
                       class="text-decoration-none text-dark">
                        <div class="ratio ratio-1x1" style="width:54px; height:54px">
                            <img src="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
                                 alt="{{ $coupon->store->name ?? '' }}"
                                 class="rounded object-fit-cover">
                        </div>
                    </a>

                    <div>
                        <h6 class="mb-1">
                            {{ $coupon->name ?? '' }}
                        </h6>

                        <a href="{{ $coupon->store->store_url ?? '#' }}"
                           class="text-decoration-none text-dark">
                            <p class="smaller m-0">
                                {{ $coupon->store->name ?? '' }}
                                <img src="{{ asset('images/icons/check-verify-second.svg') }}"
                                     alt="Verified">
                            </p>
                        </a>
                    </div>

                </div>

                <div>
                    <button
                        class="btn px-2 custom-btn rounded-pill get-code-btn text-nowrap"
                        data-image="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
                        data-code="{{ $code ?? '' }}"
                        data-name="{{ $coupon->name ?? '' }}"
                        data-type="{{ $type ?? '' }}"
                        data-link="{{ $coupon->store->store_url ?? '' }}">
                        {{ $btnText ?? '' }}
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    @empty

    <div class="col-12">
        <p class="text-center text-muted mb-0">
            No coupons found.
        </p>
    </div>

    @endforelse

</div>

<div class="mt-5">
    {{ $coupons->links('pagination::bootstrap-5') }}
</div>


</div>

@endsection
@push('scripts')

<script>

let timer;

$('input[name="search"]').on('keyup', function(){

    clearTimeout(timer);

    timer = setTimeout(() => {

        $(this).closest('form').submit();

    }, 500);

});

</script>

@endpush
