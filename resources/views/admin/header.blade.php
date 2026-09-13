<!doctype html>
<html lang="en">
@php
    $setting = \App\Models\Setting::first();
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Coupon Night</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
       <link rel="icon" type="image/png" href="{{ asset($setting->favicone ?? '') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}?v={{ time() }}">

    <style>
    .select2-container .select2-selection--single {
        height: 36px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }

    /* .app-sidebar {
            width: 260px;
            background: #1d2327 !important;
            overflow: visible !important;
            z-index: 1050;
        } */

    .app-sidebar {
        width: 260px;
        background: #1d2327 !important;
        overflow: visible !important;
        z-index: 1050;
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: sticky;
        top: 0;
    }

    .sidebar-brand {
        background: #1d2327;
        border-bottom: 1px solid #2c3338;
        height: 64px;
    }

    /* 
        .sidebar-wrapper {
            padding-top: 8px;
            overflow: visible !important;
        } */

    .sidebar-wrapper {
        padding-top: 8px;
        overflow-y: auto !important;
        /* scroll enable karo */
        overflow-x: visible !important;
        /* submenu ke liye visible */
        flex: 1;
        height: calc(100vh - 64px);
        /* brand height minus */
    }


    /* .sidebar-menu {
            padding-left: 0;
            margin: 0;
            list-style: none;
            position: relative;
        } */
    .sidebar-menu {
        padding-left: 0;
        margin: 0;
        list-style: none;
        position: relative;
        overflow: visible !important;
    }

    /*.sidebar-menu .nav-item {
            position: relative;
        } */

    .sidebar-menu .nav-item {
        position: relative;
        overflow: visible !important;
    }

    .sidebar-menu .nav-link {
        border-radius: 0;
        margin: 0;
        padding: 10px 14px;
        color: #c3c4c7 !important;
        transition: 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-menu .nav-link p {
        margin: 0;
        width: 100%;
        display: flex;
        align-items: center;
    }

    .sidebar-menu .nav-link:hover,
    .sidebar-menu .nav-link.active {
        background: #2271b1;
        color: #fff !important;
    }

    .sidebar-menu .nav-link:hover i,
    .sidebar-menu .nav-link.active i {
        color: #fff !important;
    }

    .sidebar-menu .nav-icon,
    .sidebar-menu .bi {
        color: #c3c4c7;
        font-size: 16px;
    }

    .hsn_main {
        font-size: 18px !important;
    }

    .sidebar-menu .nav-arrow {
        margin-left: auto;
        font-size: 12px;
    }

    /* .sidebar-menu .nav-treeview {
            display: none !important;
            position: absolute;
            top: 0;
            left: 100%;
            width: 230px;
            background: #1d2327;
            padding: 6px 0;
            margin: 0;
            list-style: none;
            z-index: 99999;
            box-shadow: 3px 4px 10px rgba(0, 0, 0, 0.35);
            border-left: 1px solid #2c3338;
        } */

    .sidebar-menu .nav-treeview {
        display: none !important;
        position: fixed !important;
        width: 220px;
        background: #1d2327;
        padding: 6px 0;
        margin: 0;
        list-style: none;
        z-index: 99999 !important;
        box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.5);
        border-left: 2px solid #2271b1;
        border-radius: 0 4px 4px 0;
    }

    .sidebar-menu .nav-item:hover>.nav-treeview {
        display: block !important;
    }

    .sidebar-menu .nav-treeview .nav-link {
        padding: 9px 14px;
        font-size: 14px;
        color: #c3c4c7 !important;
        white-space: nowrap;
        gap: 8px;
    }

    .sidebar-menu .nav-treeview .nav-link:hover,
    .sidebar-menu .nav-treeview .nav-link.active {
        background: #2c3338;
        color: #72aee6 !important;
    }

    .sidebar-menu .nav-treeview .nav-link:hover i {
        color: #72aee6 !important;
    }

    .sidebar-menu .nav-treeview .nav-icon {
        font-size: 10px;
    }

    .app-main {
        position: relative;
        z-index: 1;
    }

    @media (max-width: 991px) {
        .sidebar-menu .nav-treeview {
            position: static;
            width: 100%;
            box-shadow: none;
            border-left: 0;
        }

        .sidebar-menu .nav-item:hover>.nav-treeview {
            display: block !important;
        }
    }

    .note-modal-backdrop {
        display: none !important
    }

    .note-modal-content {
        top: 60px !important;
    }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('public/' . Auth::user()->image) }}"
                                class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset('public/' . Auth::user()->image) }}" class="rounded-circle shadow"
                                    alt="User Image" />
                                <p>
                                    {{ Auth::user()->first_name ?? ''}} {{ Auth::user()->last_name ?? ''}}
                                    <small>{{ Auth::user()->designation ?? '' }}</small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end">Sign out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="{{ url('/admin/dashboard') }}" class="brand-link">
                    <img src="{{ asset('public/admin/images/logo.png') }}" alt="Logo"
                        class="brand-image opacity-75 shadow" />
                    <span class="brand-text fw-light"></span>
                </a>
            </div>

            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" role="menu">

                        <li class="nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer2 hsn_main"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                                <li class="nav-item">
                            <a href="{{ url('admin/activity-report') }}"
                                class="nav-link ">
                                <i class="nav-icon bi bi-speedometer2 hsn_main"></i>
                                <p>Employee Report</p>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('store_approval'))
                        <li class="nav-item">
                               <a href="{{ route('admin.stores.approval.stores') }}" class="nav-link">
                                  <i class="nav-icon bi bi-speedometer2 hsn_main"></i><p>Store Approval</p>
                                </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('category'))
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-grid hsn_main"></i>
                                <p>Categories </p>
                            </a>

                            <ul class="nav nav-treeview" id="categoryMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link">

                                        <p>Add Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link">

                                        <p>View Categories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('network'))
                        <li class="nav-item">
                            <a href="{{ route('admin.networks.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-diagram-3 hsn_main"></i>
                                <p>Network </p>
                            </a>

                            <ul class="nav nav-treeview" id="networkMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.networks.create') }}" class="nav-link">

                                        <p>Add Network</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.networks.index') }}" class="nav-link">

                                        <p>View Network</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('blog'))
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-posts.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-journal-text hsn_main"></i>
                                <p>Blog </p>
                            </a>

                            <ul class="nav nav-treeview" id="blogMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.blog-posts.create') }}" class="nav-link">

                                        <p>Add Post</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.blog-posts.index') }}" class="nav-link">

                                        <p>View Post</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('event'))
                        <li class="nav-item">
                            <a href="{{ route('admin.events.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-journal-text hsn_main"></i>
                                <p>Events</p>
                            </a>

                            <ul class="nav nav-treeview" id="blogMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.events.create') }}" class="nav-link">

                                        <p>Add Events</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.events.index') }}" class="nav-link">

                                        <p>View Events</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('store') ||
                        auth()->user()->hasPermission('store_report') ||
                        auth()->user()->hasPermission('store_general_faqs'))
                        <li class="nav-item">
                            <a href="{{ route('admin.stores.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-shop hsn_main"></i>
                                <p>Store </p>
                            </a>

                            <ul class="nav nav-treeview" id="storeMenu">
                                @if(auth()->user()->hasPermission('store'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.stores.create') }}" class="nav-link">

                                        <p>Add Store</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.stores.index') }}" class="nav-link">

                                        <p>View Store</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('store_report'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.stores.completion.report') }}" class="nav-link">
                                            <p>Pending Store</p>
                                        </a>
                                    </li>
                                @endif

                                @if(auth()->user()->hasPermission('store_general_faqs'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.general-faqs.create') }}" class="nav-link">

                                        <p>Add General FAQ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.general-faqs.index') }}" class="nav-link">

                                        <p>View General FAQs</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('coupon') || auth()->user()->hasPermission('best_coupon'))
                        <li class="nav-item">
                            <a href="{{ route('admin.coupons.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-ticket-perforated hsn_main"></i>
                                <p>Coupons </p>
                            </a>

                            <ul class="nav nav-treeview" id="couponsMenu">
                                @if(auth()->user()->hasPermission('coupon'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupons.create') }}" class="nav-link">

                                        <p>Add Coupon</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupons.index') }}" class="nav-link">

                                        <p>View Coupon</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('best_coupon'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.best-coupons.create') }}" class="nav-link">

                                        <p>Add Best Coupon</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.best-coupons.index') }}" class="nav-link">

                                        <p>Best Coupon Codes</p>
                                    </a>
                                </li>
                                @endif
                                <!-- <li class="nav-item">
                                        <a href="{{ route('admin.coupons.active-by-store') }}" class="nav-link">
                                            
                                            <p>Active Coupons By Store</p>
                                        </a>
                                    </li> -->
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('message'))
                        <li class="nav-item">
                            <a href="{{ route('admin.messages.ajax') }}" class="nav-link">
                                <i class="nav-icon bi bi-envelope hsn_main"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('slider'))
                        <li class="nav-item">
                            <a href="{{ route('admin.slider-images.index') }}"
                                class="nav-link {{ request()->is('admin/slider-images') ? 'active' : '' }}">
                                <i class="bi bi-sliders hsn_main"></i>
                                <p>Hero Section</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('product'))
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-box hsn_main"></i>
                                <p>Products </p>
                            </a>

                            <ul class="nav nav-treeview" id="productMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.create') }}" class="nav-link">

                                        <p>Add Product</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.index') }}" class="nav-link">

                                        <p>View Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('upcoming_event'))
                        <li class="nav-item">
                            <a href="{{ route('admin.upcoming-events.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-box hsn_main"></i>
                                <p>Upcoming Event</p>
                            </a>

                            <ul class="nav nav-treeview" id="productMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.upcoming-events.create') }}" class="nav-link">
                                        <p>Add Upcoming Event</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.upcoming-events.index') }}" class="nav-link">

                                        <p>View Upcoming Event</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(
                        auth()->user()->hasPermission('help') ||
                        auth()->user()->hasPermission('term') ||
                        auth()->user()->hasPermission('affiliate') ||
                        auth()->user()->hasPermission('disclaimer') ||
                        auth()->user()->hasPermission('privacy') ||
                        auth()->user()->hasPermission('faqs')
                        )
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-text hsn_main"></i>
                                <p>Legal Pages </p>
                            </a>

                            <ul class="nav nav-treeview" id="legalMenu">
                                @if(auth()->user()->hasPermission('help'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.help-faqs.create') }}" class="nav-link">
                                        <p>Add Help</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('term'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.terms.create') }}" class="nav-link">

                                        <p>Add Terms</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('affiliate'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.affiliate.create') }}" class="nav-link">
                                        <p>Add Affiliate</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('disclaimer'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.disclaimer.create') }}" class="nav-link">
                                        <p>Add Disclaimer</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('privacy'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.privacy.create') }}" class="nav-link">
                                        <p>Add Privacy</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('faqs'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.faq.create') }}" class="nav-link">
                                        <p>Add FAQS</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('user'))
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-person hsn_main"></i>
                                <p>Users </p>
                            </a>

                            <ul class="nav nav-treeview" id="userMenu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.create') }}" class="nav-link">
                                        <p>Add User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.index') }}" class="nav-link">

                                        <p>View User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.activity') }}" class="nav-link">

                                        <p>User Activities</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermission('submitted_offer'))
                        <li class="nav-item">
                            <a href="{{ route('admin.submitted.offers.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-send hsn_main"></i>
                                <p>Submitted Offers</p>
                            </a>
                        </li>
                        @endif

                        @if(
                        auth()->user()->hasPermission('site_setting') ||
                        auth()->user()->hasPermission('home_setting') ||
                        auth()->user()->hasPermission('theme_setting') ||
                        auth()->user()->hasPermission('marque') ||
                        auth()->user()->hasPermission('geo_restriction')
                        )
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear hsn_main"></i>
                                <p>Settings </p>
                            </a>

                            <ul class="nav nav-treeview" id="userMenu">
                                @if(auth()->user()->hasPermission('site_setting'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.setting.index') }}" class="nav-link">
                                        <p>Site Setting</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('home_setting'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.home.page') }}" class="nav-link">
                                        <p>Home Setting</p>
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->hasPermission('home_setting'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.home.page.popup') }}" class="nav-link">
                                        <p>Home Popup</p>
                                    </a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('theme_setting'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.theme-settings.edit') }}" class="nav-link">
                                        <p>Theme Setting</p>
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->hasPermission('marque'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.marque.index') }}" class="nav-link">
                                        <p>Marque</p>
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->hasPermission('geo_restriction'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.geo.index') }}" class="nav-link">
                                        <p>GEO Restriction</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="app-main">