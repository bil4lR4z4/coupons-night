@extends('admin.master')

@section('title', 'Edit Site Setting')

@section('content')


<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- Left Side Form -->
        <div class="col-lg-7">

            <form action="{{ route('admin.theme-settings.update') }}" method="POST">
                @csrf

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Theme Settings</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">
                            Customize header, buttons, footer, and hover colors. By default, gradient is selected for background areas.
                        </p>
                    </div>
                </div>

                <!-- Header Settings -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Header Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Header Background Type</label>
                                <select name="header_bg_type" class="form-select bg-type-toggle" data-target="header">
                                    <option value="gradient" {{ ($settings['header_bg_type'] ?? 'gradient') == 'gradient' ? 'selected' : '' }}>Gradient</option>
                                    <option value="solid" {{ ($settings['header_bg_type'] ?? '') == 'solid' ? 'selected' : '' }}>Solid</option>
                                </select>
                            </div>

                            <div class="col-md-6 header-solid-group">
                                <label class="form-label fw-semibold">Header Solid Color</label>
                                <input type="color" name="header_solid_color" class="form-control form-control-color"
                                    value="{{ $settings['header_solid_color'] ?? '#C0392B' }}">
                            </div>

                            <div class="col-md-6 header-gradient-group">
                                <label class="form-label fw-semibold">Header Gradient Color 1</label>
                                <input type="color" name="header_gradient_color_1" class="form-control form-control-color"
                                    value="{{ $settings['header_gradient_color_1'] ?? '#8B2500' }}">
                            </div>

                            <div class="col-md-6 header-gradient-group">
                                <label class="form-label fw-semibold">Header Gradient Color 2</label>
                                <input type="color" name="header_gradient_color_2" class="form-control form-control-color"
                                    value="{{ $settings['header_gradient_color_2'] ?? '#E8735A' }}">
                            </div>

                            <div class="col-md-6 header-gradient-group">
                                <label class="form-label fw-semibold">Header Gradient Direction</label>
                                <select name="header_gradient_direction" class="form-select">
                                    <option value="90deg" {{ ($settings['header_gradient_direction'] ?? '90deg') == '90deg' ? 'selected' : '' }}>Left to Right</option>
                                    <option value="180deg" {{ ($settings['header_gradient_direction'] ?? '') == '180deg' ? 'selected' : '' }}>Top to Bottom</option>
                                    <option value="135deg" {{ ($settings['header_gradient_direction'] ?? '') == '135deg' ? 'selected' : '' }}>Diagonal</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Header Text Color</label>
                                <input type="color" name="header_text_color" class="form-control form-control-color"
                                    value="{{ $settings['header_text_color'] ?? '#FFFFFF' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Settings -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Button Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Button Background Type</label>
                                <select name="button_bg_type" class="form-select bg-type-toggle" data-target="button">
                                    <option value="gradient" {{ ($settings['button_bg_type'] ?? 'gradient') == 'gradient' ? 'selected' : '' }}>Gradient</option>
                                    <option value="solid" {{ ($settings['button_bg_type'] ?? '') == 'solid' ? 'selected' : '' }}>Solid</option>
                                </select>
                            </div>

                            <div class="col-md-6 button-solid-group">
                                <label class="form-label fw-semibold">Button Solid Color</label>
                                <input type="color" name="button_solid_color" class="form-control form-control-color"
                                    value="{{ $settings['button_solid_color'] ?? '#C0392B' }}">
                            </div>

                            <div class="col-md-6 button-gradient-group">
                                <label class="form-label fw-semibold">Button Gradient Color 1</label>
                                <input type="color" name="button_gradient_color_1" class="form-control form-control-color"
                                    value="{{ $settings['button_gradient_color_1'] ?? '#A93226' }}">
                            </div>

                            <div class="col-md-6 button-gradient-group">
                                <label class="form-label fw-semibold">Button Gradient Color 2</label>
                                <input type="color" name="button_gradient_color_2" class="form-control form-control-color"
                                    value="{{ $settings['button_gradient_color_2'] ?? '#E74C3C' }}">
                            </div>

                            <div class="col-md-6 button-gradient-group">
                                <label class="form-label fw-semibold">Button Gradient Direction</label>
                                <select name="button_gradient_direction" class="form-select">
                                    <option value="90deg" {{ ($settings['button_gradient_direction'] ?? '90deg') == '90deg' ? 'selected' : '' }}>Left to Right</option>
                                    <option value="180deg" {{ ($settings['button_gradient_direction'] ?? '') == '180deg' ? 'selected' : '' }}>Top to Bottom</option>
                                    <option value="135deg" {{ ($settings['button_gradient_direction'] ?? '') == '135deg' ? 'selected' : '' }}>Diagonal</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Button Text Color</label>
                                <input type="color" name="button_text_color" class="form-control form-control-color"
                                    value="{{ $settings['button_text_color'] ?? '#FFFFFF' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Settings -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Footer Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Footer Background Type</label>
                                <select name="footer_bg_type" class="form-select bg-type-toggle" data-target="footer">
                                    <option value="gradient" {{ ($settings['footer_bg_type'] ?? 'gradient') == 'gradient' ? 'selected' : '' }}>Gradient</option>
                                    <option value="solid" {{ ($settings['footer_bg_type'] ?? '') == 'solid' ? 'selected' : '' }}>Solid</option>
                                </select>
                            </div>

                            <div class="col-md-6 footer-solid-group">
                                <label class="form-label fw-semibold">Footer Solid Color</label>
                                <input type="color" name="footer_solid_color" class="form-control form-control-color"
                                    value="{{ $settings['footer_solid_color'] ?? '#212529' }}">
                            </div>

                            <div class="col-md-6 footer-gradient-group">
                                <label class="form-label fw-semibold">Footer Gradient Color 1</label>
                                <input type="color" name="footer_gradient_color_1" class="form-control form-control-color"
                                    value="{{ $settings['footer_gradient_color_1'] ?? '#111111' }}">
                            </div>

                            <div class="col-md-6 footer-gradient-group">
                                <label class="form-label fw-semibold">Footer Gradient Color 2</label>
                                <input type="color" name="footer_gradient_color_2" class="form-control form-control-color"
                                    value="{{ $settings['footer_gradient_color_2'] ?? '#333333' }}">
                            </div>

                            <div class="col-md-6 footer-gradient-group">
                                <label class="form-label fw-semibold">Footer Gradient Direction</label>
                                <select name="footer_gradient_direction" class="form-select">
                                    <option value="90deg" {{ ($settings['footer_gradient_direction'] ?? '90deg') == '90deg' ? 'selected' : '' }}>Left to Right</option>
                                    <option value="180deg" {{ ($settings['footer_gradient_direction'] ?? '') == '180deg' ? 'selected' : '' }}>Top to Bottom</option>
                                    <option value="135deg" {{ ($settings['footer_gradient_direction'] ?? '') == '135deg' ? 'selected' : '' }}>Diagonal</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Footer Text Color</label>
                                <input type="color" name="footer_text_color" class="form-control form-control-color"
                                    value="{{ $settings['footer_text_color'] ?? '#FFFFFF' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Banner Settings -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Banner Settings</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Banner Background Type</label>
                <select name="banner_bg_type" class="form-select bg-type-toggle" data-target="banner">
                    <option value="gradient" {{ ($settings['banner_bg_type'] ?? 'gradient') == 'gradient' ? 'selected' : '' }}>Gradient</option>
                    <option value="solid" {{ ($settings['banner_bg_type'] ?? '') == 'solid' ? 'selected' : '' }}>Solid</option>
                </select>
            </div>

            <div class="col-md-6 banner-solid-group">
                <label class="form-label fw-semibold">Banner Solid Color</label>
                <input type="color" name="banner_solid_color" class="form-control form-control-color"
                    value="{{ $settings['banner_solid_color'] ?? '#C0392B' }}">
            </div>

            <div class="col-md-6 banner-gradient-group">
                <label class="form-label fw-semibold">Banner Gradient Color 1</label>
                <input type="color" name="banner_gradient_color_1" class="form-control form-control-color"
                    value="{{ $settings['banner_gradient_color_1'] ?? '#8B2500' }}">
            </div>

            <div class="col-md-6 banner-gradient-group">
                <label class="form-label fw-semibold">Banner Gradient Color 2</label>
                <input type="color" name="banner_gradient_color_2" class="form-control form-control-color"
                    value="{{ $settings['banner_gradient_color_2'] ?? '#E8735A' }}">
            </div>

            <div class="col-md-6 banner-gradient-group">
                <label class="form-label fw-semibold">Banner Gradient Direction</label>
                <select name="banner_gradient_direction" class="form-select">
                    <option value="90deg">Left to Right</option>
                    <option value="180deg">Top to Bottom</option>
                    <option value="135deg">Diagonal</option>
                </select>
            </div>

        </div>
    </div>
</div>

                <!-- Links -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Link & Hover Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Link Color</label>
                                <input type="color" name="link_color" class="form-control form-control-color"
                                    value="{{ $settings['link_color'] ?? '#C0392B' }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Link Hover Color</label>
                                <input type="color" name="link_hover_color" class="form-control form-control-color"
                                    value="{{ $settings['link_hover_color'] ?? '#8E2B20' }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Text Hover Color</label>
                                <input type="color" name="text_hover_color" class="form-control form-control-color"
                                    value="{{ $settings['text_hover_color'] ?? '#C0392B' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-primary px-4">Save Theme Settings</button>
                </div>
            </form>
        </div>

        <!-- Right Side Preview -->
        <div class="col-lg-5">
            <div class="position-sticky" style="top: 20px;">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Mobile Live Preview</h5>
                    </div>
                    <div class="card-body d-flex justify-content-center bg-light">
                        <div class="mobile-preview shadow">
                            <div class="mobile-notch"></div>

                            <div id="preview-header" class="mobile-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">CouponNight</span>
                                    <span>☰</span>
                                </div>
                            </div>

                            <div class="mobile-body">
                                <div class="mb-3">
                                    <small id="preview-link" class="text-decoration-none">Test Link Color</small>
                                </div>
 
                                <div id="preview-banner" style="padding:10px; text-align:center; font-weight:bold;">
    Banner Preview
</div>
                                <h6 id="preview-hover-text" class="fw-bold mb-2">Test Text Color</h6>

                                <p class="text-muted small mb-3">
                                    Explore exclusive deals and latest promo codes from your favorite stores.
                                </p>

                                <button type="button" id="preview-button" class="btn w-100 py-2">
                                    Get Coupon
                                </button>

                                <!-- <div class="mt-4 p-3 rounded bg-white border">
                                    <small class="text-muted d-block mb-1">Coupon Card</small>
                                    <strong>20% OFF</strong>
                                    <p class="mb-0 small text-muted">On selected categories</p>
                                </div> -->
                            </div>

                            <div id="preview-footer" class="mobile-footer text-center">
                                <small>Footer Preview</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .mobile-preview {
        width: 320px;
        max-width: 100%;
        background: #fff;
        border-radius: 28px;
        overflow: hidden;
        border: 8px solid #111;
        position: relative;
    }

    .mobile-notch {
        width: 120px;
        height: 22px;
        background: #111;
        border-radius: 0 0 16px 16px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }

    .mobile-header {
        padding: 32px 18px 16px;
        color: #fff;
    }

    .mobile-body {
        padding: 18px;
        min-height: 420px;
        background: #f8f9fa;
    }

    .mobile-footer {
        padding: 14px 18px;
        color: #fff;
    }

    @media (max-width: 991.98px) {
        .mobile-preview {
            width: 100%;
            max-width: 340px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function toggleGroups(section) {
        const type = document.querySelector(`[name="${section}_bg_type"]`).value;
        const solidGroups = document.querySelectorAll(`.${section}-solid-group`);
        const gradientGroups = document.querySelectorAll(`.${section}-gradient-group`);

        if (type === 'solid') {
            solidGroups.forEach(el => el.style.display = 'block');
            gradientGroups.forEach(el => el.style.display = 'none');
        } else {
            solidGroups.forEach(el => el.style.display = 'none');
            gradientGroups.forEach(el => el.style.display = 'block');
        }
    }

    function getBackgroundStyle(section) {
        const type = document.querySelector(`[name="${section}_bg_type"]`).value;

        if (type === 'solid') {
            return document.querySelector(`[name="${section}_solid_color"]`).value;
        }

        const color1 = document.querySelector(`[name="${section}_gradient_color_1"]`).value;
        const color2 = document.querySelector(`[name="${section}_gradient_color_2"]`).value;
        const direction = document.querySelector(`[name="${section}_gradient_direction"]`).value;

        return `linear-gradient(${direction}, ${color1} 0%, ${color2} 100%)`;
    }

    function updatePreview() {
        document.getElementById('preview-header').style.background = getBackgroundStyle('header');
        document.getElementById('preview-header').style.color =
            document.querySelector('[name="header_text_color"]').value;

        document.getElementById('preview-button').style.background = getBackgroundStyle('button');
        document.getElementById('preview-button').style.color =
            document.querySelector('[name="button_text_color"]').value;
        document.getElementById('preview-button').style.border = 'none';

        document.getElementById('preview-footer').style.background = getBackgroundStyle('footer');
        document.getElementById('preview-footer').style.color =
            document.querySelector('[name="footer_text_color"]').value;
document.getElementById('preview-banner').style.background = getBackgroundStyle('banner');
        document.getElementById('preview-link').style.color =
            document.querySelector('[name="link_color"]').value;

        document.getElementById('preview-hover-text').style.color =
            document.querySelector('[name="text_hover_color"]').value;
    }

    ['header', 'button', 'footer'].forEach(section => toggleGroups(section));

    document.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('change', function () {
            ['header', 'button', 'footer', 'banner'].forEach(section => toggleGroups(section));
            updatePreview();
        });

        el.addEventListener('input', function () {
            updatePreview();
        });
    });

    updatePreview();
});
</script>
@endsection
