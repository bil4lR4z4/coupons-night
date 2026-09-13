
@extends('layouts.app')

@section('title', 'CouponNight Sitemap – Browse All Coupons & Pages')
@section('meta_description', 'Browse all stores, coupon categories, blogs, events, and deal pages available on CouponNight in one place.')

@section('content')

<style>

.category-chip,
.group-box{
    border:1px solid #e9e9e9;
}

.category-icon{
    width:54px;
    height:54px;
    font-size:11px;
}

.category-link{
    text-decoration:none;
    color:inherit;
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

        <small class="d-block mb-1">
            Browse Coupons
        </small>

        <h2 class="fw-bold mb-0">
            Discover Popular Stores
        </h2>

        <div class="help-search-box mt-4">

            <input
                type="text"
                id="storeSearch"
                class="form-control"
                placeholder="Search stores...">

        </div>

    </div>

</div>


<div class="container mb-bottom px-20">

    <div class="row g-3 mb-4 mb-lg-5">

        @forelse($stores as $store)

        <div class="col-xl-3 col-lg-4 col-md-6 col-6 store-item">

            <a href="{{ route('store.show', $store->slug) }}"
               class="category-link">

                <div class="category-chip bg-white rounded-4 shadow-sm px-3 py-2 h-100">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="category-icon rounded-circle text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0 overflow-hidden"
                            style="background:aliceblue;border:2px solid #000;">

                            @if(!empty($store->logo))

                                <img
                                    src="{{ asset('uploads/stores/' . $store->logo) }}"
                                    alt="{{ $store->name }}"
                                    class="w-100 h-100"
                                    style="object-fit:cover;">

                            @else

                                {{ strtoupper(substr($store->name,0,2)) }}

                            @endif

                        </div>

                        <span class="small fw-medium text-dark store-name">

                            {{ $store->name }}

                        </span>

                    </div>

                </div>

            </a>

        </div>

        @empty

        <div class="col-12">

            <p class="text-center text-muted mb-0">

                No stores found.

            </p>

        </div>

        @endforelse

    </div>


    <div id="noResult"
         class="alert alert-warning text-center d-none">

        No matching store found

    </div>


    @if($stores->hasPages())

    <div class="mt-5">

        {{ $stores->links('pagination::bootstrap-5') }}

    </div>

    @endif

</div>

@endsection


@push('scripts')

<script>

document.getElementById('storeSearch').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();

    let items = document.querySelectorAll('.store-item');

    let found = false;

    items.forEach(function(item) {

        let name = item.querySelector('.store-name')
                       .innerText
                       .toLowerCase();

        if (name.includes(keyword)) {

            item.style.display = '';

            found = true;

        }
        else {

            item.style.display = 'none';

        }

    });

    document.getElementById('noResult')
            .classList.toggle('d-none', found);

});

</script>

@endpush

