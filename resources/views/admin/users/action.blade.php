@extends('admin.master')

@section('title', 'All Users')

@section('content')
<div class="container-fluid">

    <x-breadcrumb 
        parent-label="Users"
        parent-route="{{ route('admin.user.index') }}"
        current-page-title="{{ isset($edit) ? 'Update' : 'Add'}} User"
    />

    <div class="card shadow-sm">

        <div class="card-body">
            <x-form method="post" action="{{ isset($edit) ? route('admin.user.update', $edit->id) : route('admin.user.store') }}">
                <div class="row row-cols-2">
                    <x-input
                        type="text"
                        name="first_name"
                        value="{{ $edit->first_name ?? ''}}"
                        placeholder="First Name"
                        label="First Name"
                    />

                    <x-input
                        type="text"
                        name="last_name"
                        value="{{ $edit->last_name ?? ''}}"
                        placeholder="Last Name"
                        label="Last Name"
                    />

                    <x-input
                        type="text"
                        name="username"
                        value="{{ $edit->username ?? ''}}"
                        placeholder="Username"
                        label="Username"
                    />

                    <x-input
                        type="email"
                        name="email"
                        value="{{ $edit->email ?? ''}}"
                        placeholder="Email"
                        label="Email"
                    />
               
                    <x-password
                        name="password"
                        label="Password"
                        placeholder="Enter password"
                    />

                    <x-password
                        name="confirm_password"
                        label="Confirm Password"
                        placeholder="Enter confirm password"
                    />

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active" 
                                {{ old('status', $edit->status ?? '') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="blocked" 
                                {{ old('status', $edit->status ?? '') == 'blocked' ? 'selected' : '' }}>
                                Blocked
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <select class="form-select" name="designation">
                            <option value="Administrator" 
                                {{ old('designation', $edit->designation ?? '') == 'Administrator' ? 'selected' : '' }}>
                                Administrator
                            </option>
                            <option value="Developer" 
                                {{ old('designation', $edit->designation ?? '') == 'Developer' ? 'selected' : '' }}>
                                Developer
                            </option>
                            <option value="SEO" 
                                {{ old('designation', $edit->designation ?? '') == 'SEO' ? 'selected' : '' }}>
                                SEO
                            </option>
                            <option value="Content Writer" 
                                {{ old('designation', $edit->designation ?? '') == 'Content Writer' ? 'selected' : '' }}>
                                Content Writer
                            </option>
                            <option value="Data Entry (Coupons)" 
                                {{ old('designation', $edit->designation ?? '') == 'Data Entry (Coupons)' ? 'selected' : '' }}>
                                Data Entry (Coupons)
                            </option>
                        </select>
                        @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <h1 class="w-100">User Permissions</h1>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="category">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="category" name="category" {{ old('category', $edit->permission->category ?? 0) ? 'checked' : '' }}>
                            Category Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="network">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="network" name="network" {{ old('network', $edit->permission->network ?? 0) ? 'checked' : '' }}>
                            Network Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="blog">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="blog" name="blog" {{ old('blog', $edit->permission->blog ?? 0) ? 'checked' : '' }}>
                            Blog Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="store">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="store" name="store" {{ old('store', $edit->permission->store ?? 0) ? 'checked' : '' }}>
                            Store Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="store_approval">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="store_approval" name="store_approval" {{ old('store_approval', $edit->permission->store_approval ?? 0) ? 'checked' : '' }}>
                            Store Approval Page
                        </label>
                    </div>

                     <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="store_report">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="store_report" name="store_report" {{ old('store_report', $edit->permission->store_report ?? 0) ? 'checked' : '' }}>
                            Store Report Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="store_general_faqs">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="store_general_faqs" name="store_general_faqs" {{ old('store_general_faqs', $edit->permission->store_general_faqs ?? 0) ? 'checked' : '' }}>
                            Store General FAQs Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="coupon">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="coupon" name="coupon" {{ old('coupon', $edit->permission->coupon ?? 0) ? 'checked' : '' }}>
                            Coupon Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="best_coupon">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="best_coupon" name="best_coupon" {{ old('best_coupon', $edit->permission->best_coupon ?? 0) ? 'checked' : '' }}>
                            Best Coupon Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="message">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="message" name="message" {{ old('message', $edit->permission->message ?? 0) ? 'checked' : '' }}>
                            Messages Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="product">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="product" name="product" {{ old('product', $edit->permission->product ?? 0) ? 'checked' : '' }}>
                            Product Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="event">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="event" name="event" {{ old('event', $edit->permission->event ?? 0) ? 'checked' : '' }}>
                            Event Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="user">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="user" name="user" {{ old('user', $edit->permission->user ?? 0) ? 'checked' : '' }}>
                            User Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="user_activity">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="user_activity" name="user_activity" {{ old('user_activity', $edit->permission->user_activity ?? 0) ? 'checked' : '' }}>
                            User Activity Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="submitted_offer">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="submitted_offer" name="submitted_offer" {{ old('submitted_offer', $edit->permission->submitted_offer ?? 0) ? 'checked' : '' }}>
                            Submitted Offers Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="theme_setting">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="theme_setting" name="theme_setting" {{ old('theme_setting', $edit->permission->theme_setting ?? 0) ? 'checked' : '' }}>
                            Theme Setting Offers Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="site_setting">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="site_setting" name="site_setting" {{ old('site_setting', $edit->permission->site_setting ?? 0) ? 'checked' : '' }}>
                            Site Setting Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="home_setting">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="home_setting" name="home_setting" {{ old('home_setting', $edit->permission->home_setting ?? 0) ? 'checked' : '' }}>
                            Home Setting Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="term">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="term" name="term" {{ old('term', $edit->permission->term ?? 0) ? 'checked' : '' }}>
                            Terms Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="help">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="help" name="help" {{ old('help', $edit->permission->help ?? 0) ? 'checked' : '' }}>
                            Help Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="affiliate">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="affiliate" name="affiliate" {{ old('affiliate', $edit->permission->affiliate ?? 0) ? 'checked' : '' }}>
                            Affiliate Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="disclaimer">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="disclaimer" name="disclaimer" {{ old('disclaimer', $edit->permission->disclaimer ?? 0) ? 'checked' : '' }}>
                            Disclaimer Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="privacy">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="privacy" name="privacy" {{ old('privacy', $edit->permission->privacy ?? 0) ? 'checked' : '' }}>
                            Privacy Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="faqs">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="faqs" name="faqs" {{ old('faqs', $edit->permission->faqs ?? 0) ? 'checked' : '' }}>
                            FAQs Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="slider">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="slider" name="slider" {{ old('slider', $edit->permission->slider ?? 0) ? 'checked' : '' }}>
                            Slider Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="marque">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="marque" name="marque" {{ old('marque', $edit->permission->marque ?? 0) ? 'checked' : '' }}>
                            Marque Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="upcoming_event">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="upcoming_event" name="upcoming_event" {{ old('upcoming_event', $edit->permission->upcoming_event ?? 0) ? 'checked' : '' }}>
                            Upcoming Event Page
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label border p-3 rounded w-100" for="geo_restriction">
                            <input class="form-check-input me-3" type="checkbox" value="1" id="geo_restriction" name="geo_restriction" {{ old('geo_restriction', $edit->permission->geo_restriction ?? 0) ? 'checked' : '' }}>
                            Geo Restriction Page
                        </label>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">{{ isset($edit) ? 'Update' : 'Save'}} User</button>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush