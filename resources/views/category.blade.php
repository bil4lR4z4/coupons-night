
@extends('layouts.app')

@section('title', 'Coupon Categories – Browse Deals & Discount Offers')
@section('meta_description', 'Explore coupon categories for fashion, electronics, beauty, food, travel, and more. Find verified promo codes and online deals updated daily.')

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

.group-list a{
    color:#495057;
    text-decoration:none;
    font-size:13px;
}

.group-list a:hover{
    color:#dc3545;
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
            Stores By Categories
        </h2>

        <div class="help-search-box mt-4">

            <input
                type="text"
                id="categorySearch"
                class="form-control"
                placeholder="Search categories...">

        </div>

    </div>

</div>


<div class="container mb-bottom px-20">

    {{-- Small category boxes --}}
    <div class="row g-3 mb-4 mb-lg-5">

        @forelse($categories as $category)

        <div class="col-xl-3 col-lg-4 col-md-6 col-12 category-item">

            <a href="{{ route('coupon_category.page', $category->slug) }}"
               class="category-link">

                <div class="category-chip bg-white rounded-4 shadow-sm px-3 py-2 h-100">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="category-icon rounded-circle text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0 overflow-hidden"
                            style="background:aliceblue;border:2px solid #000;">

                            @if(!empty($category->image))

                                <img
                                    src="{{ asset('uploads/categories/'.$category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="w-100 h-100"
                                    style="object-fit:cover;">

                            @else

                                {{ strtoupper(substr($category->name,0,2)) }}

                            @endif

                        </div>

                        <span class="small fw-medium text-dark category-name">

                            {{ $category->name }}

                        </span>

                    </div>

                </div>

            </a>

        </div>

        @empty

        <div class="col-12">

            <p class="text-center text-muted mb-0">

                No categories found.

            </p>

        </div>

        @endforelse

    </div>


    {{-- No Result --}}
    <div
        id="noResult"
        class="alert alert-warning text-center d-none">

        No matching category found

    </div>


    {{-- Big grouped boxes --}}
    <div class="row g-4">

        @forelse($categories as $category)

            @if(isset($category->children) && $category->children->count() > 0)

            <div class="col-lg-6 col-12 category-item">

                <div class="group-box bg-white rounded-4 shadow-sm overflow-hidden h-100">

                    <div class="site-header px-3 py-2">

                        <a
                            href="{{ route('coupon_category.page', $category->slug) }}"
                            class="d-flex align-items-center gap-2 category-link">

                            <div
                                class="category-icon rounded-circle text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0 overflow-hidden">

                                @if(!empty($category->image))

                                    <img
                                        src="{{ asset('uploads/categories/'.$category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="w-100 h-100"
                                        style="object-fit:cover;">

                                @else

                                    {{ strtoupper(substr($category->name,0,2)) }}

                                @endif

                            </div>

                            <h6 class="fw-bold mb-0 category-name">

                                {{ $category->name }}

                            </h6>

                        </a>

                    </div>

                    <div class="p-3">

                        <div class="row row-cols-2 row-cols-md-3 g-2 group-list">

                            @foreach($category->children as $child)

                            <div class="col">

                                <a href="{{ route('coupon_category.page', $child->slug) }}">

                                    {{ $child->name }}

                                </a>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

            @endif

        @empty

        <div class="col-12 text-center text-muted">

            No categories found

        </div>

        @endforelse

    </div>
<div class="mt-5">
    {{ $categories->links('pagination::bootstrap-5') }}
</div>
</div>

@endsection


@push('scripts')

<script>

document.getElementById('categorySearch').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();

    let items = document.querySelectorAll('.category-item');

    let found = false;

    items.forEach(function(item){

        let name = item.querySelector('.category-name')
            .innerText
            .toLowerCase();

        if(name.includes(keyword)){

            item.style.display = '';

            found = true;

        }
        else{

            item.style.display = 'none';

        }

    });

    document.getElementById('noResult')
        .classList.toggle('d-none', found);

});

</script>

@endpush

