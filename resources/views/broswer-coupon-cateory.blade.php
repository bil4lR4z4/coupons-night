@extends('layouts.app')

@section('title', 'Top Coupons & Deal Categories')

@section('content')

<style>
    .category-icon-circle {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #e9ecef;
        background: #fff;
        padding: 10px;
    }

    .mini-label {
        font-size: 11px;
        letter-spacing: .4px;
    }

    .section-title-small {
        font-size: 11px;
        letter-spacing: .8px;
    }

    .category-links li {
        margin-bottom: .32rem;
    }

    .category-links a {
        color: #4b5563;
        text-decoration: none;
        font-size: 13px;
        line-height: 1.5;
    }

    .category-links a:hover {
        color: #dc3545;
        text-decoration: underline;
    }

 
</style>

<div class="container py-4 py-lg-5 page-wrap">

    <!-- Top Heading -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Top Coupons &amp; Deal Categories</h2>
    </div>

    <!-- Top icon categories -->
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 text-center mb-5">

        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/store/feature1.png') }}" alt="Beauty" class="category-icon-circle mb-2">
                <div class="mini-label fw-semibold text-uppercase text-secondary">Beauty</div>
            </div>
        </div>

        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/store/feature1.png') }}" alt="Electronics" class="category-icon-circle mb-2">
                <div class="mini-label fw-semibold text-uppercase text-secondary">Electronics</div>
            </div>
        </div>

        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/store/feature1.png') }}" alt="Skincare" class="category-icon-circle mb-2">
                <div class="mini-label fw-semibold text-uppercase text-secondary">Skincare</div>
            </div>
        </div>

        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/store/feature1.png') }}" alt="Furniture" class="category-icon-circle mb-2">
                <div class="mini-label fw-semibold text-uppercase text-secondary">Furniture</div>
            </div>
        </div>

        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/store/feature1.png') }}" alt="Art" class="category-icon-circle mb-2">
                <div class="mini-label fw-semibold text-uppercase text-secondary">Art</div>
            </div>
        </div>

        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('images/store/feature1.png') }}" alt="Health" class="category-icon-circle mb-2">
                <div class="mini-label fw-semibold text-uppercase text-secondary">Health</div>
            </div>
        </div>

    </div>

    <!-- Main categories listing -->
    <div class="mb-4">
        <h4 class="fw-bold mb-0">All Categories &amp; Deal Categories</h4>
    </div>

    <div class="row g-4">

        <!-- Column 1 -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Accessories</h6>
                <ul class="category-links mb-0">
                    <li><a href="#">Belts</a></li>
                    <li><a href="#">Bags</a></li>
                    <li><a href="#">Wallets</a></li>
                    <li><a href="#">Scarves</a></li>
                    <li><a href="#">Sunglasses</a></li>
                    <li><a href="#">Jewelry</a></li>
                    <li><a href="#">Watches</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Baby &amp; Toddler</h6>
                <ul class="category-links mb-0">
                    <li><a href="#">Baby Gear</a></li>
                    <li><a href="#">Feeding</a></li>
                    <li><a href="#">Nursery</a></li>
                    <li><a href="#">Diapering</a></li>
                    <li><a href="#">Toys</a></li>
                    <li><a href="#">Baby Health</a></li>
                    <li><a href="#">Strollers</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Clothing &amp; Fashion</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Men's Fashion</a></li>
                    <li><a href="#">Women's Fashion</a></li>
                    <li><a href="#">Kids Clothing</a></li>
                    <li><a href="#">Shoes</a></li>
                    <li><a href="#">Outerwear</a></li>
                    <li><a href="#">Activewear</a></li>
                    <li><a href="#">Luxury Fashion</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Health &amp; Beauty</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Hair Care</a></li>
                    <li><a href="#">Skin Care</a></li>
                    <li><a href="#">Makeup</a></li>
                    <li><a href="#">Fragrance</a></li>
                    <li><a href="#">Personal Care</a></li>
                    <li><a href="#">Wellness</a></li>
                    <li><a href="#">Supplements</a></li>
                </ul>
            </div>
        </div>

        <!-- Column 2 -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Department Stores</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Daily Deals</a></li>
                    <li><a href="#">Outlet Stores</a></li>
                    <li><a href="#">Luxury Stores</a></li>
                    <li><a href="#">Discount Stores</a></li>
                    <li><a href="#">Top Brands</a></li>
                    <li><a href="#">Essentials</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Electronics</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Audio</a></li>
                    <li><a href="#">Cameras</a></li>
                    <li><a href="#">Computers</a></li>
                    <li><a href="#">Gaming</a></li>
                    <li><a href="#">Mobile Phones</a></li>
                    <li><a href="#">Smart Home</a></li>
                    <li><a href="#">TV &amp; Video</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Home &amp; Garden</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Furniture</a></li>
                    <li><a href="#">Kitchen</a></li>
                    <li><a href="#">Appliances</a></li>
                    <li><a href="#">Home Decor</a></li>
                    <li><a href="#">Bedding</a></li>
                    <li><a href="#">Lighting</a></li>
                    <li><a href="#">Outdoor Living</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Office &amp; School</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Office Supplies</a></li>
                    <li><a href="#">Printers</a></li>
                    <li><a href="#">Backpacks</a></li>
                    <li><a href="#">Study Tools</a></li>
                    <li><a href="#">Stationery</a></li>
                    <li><a href="#">Desks &amp; Chairs</a></li>
                </ul>
            </div>
        </div>

        <!-- Column 3 -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Food &amp; Drinks</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Coffee</a></li>
                    <li><a href="#">Snacks</a></li>
                    <li><a href="#">Organic Food</a></li>
                    <li><a href="#">Meal Kits</a></li>
                    <li><a href="#">Beverages</a></li>
                    <li><a href="#">Wine</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Sports &amp; Outdoors</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Fitness</a></li>
                    <li><a href="#">Cycling</a></li>
                    <li><a href="#">Camping</a></li>
                    <li><a href="#">Running</a></li>
                    <li><a href="#">Team Sports</a></li>
                    <li><a href="#">Outdoor Gear</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Travel</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Flights</a></li>
                    <li><a href="#">Hotels</a></li>
                    <li><a href="#">Car Rentals</a></li>
                    <li><a href="#">Travel Accessories</a></li>
                    <li><a href="#">Holiday Packages</a></li>
                </ul>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase section-title-small mb-3">Toys &amp; Games</h6>
                <ul class="  category-links mb-0">
                    <li><a href="#">Action Figures</a></li>
                    <li><a href="#">Board Games</a></li>
                    <li><a href="#">Educational Toys</a></li>
                    <li><a href="#">Puzzles</a></li>
                    <li><a href="#">Video Games</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection