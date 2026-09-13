<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderImageController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\NetworkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BestCouponController;
use App\Http\Controllers\Admin\GeneralFaqController;
use App\Http\Controllers\Admin\UserLogController;
use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TermsSectionController;
use App\Http\Controllers\Admin\AffiliateSectionController;
use App\Http\Controllers\Admin\HelpFaqController;
use App\Http\Controllers\Admin\DisclaimerSectionController;
use App\Http\Controllers\Admin\PrivacySectionController;
use App\Http\Controllers\Admin\FaqItemController;
use App\Http\Controllers\Admin\SubmittedOfferController;
use App\Http\Controllers\Admin\GeoRestrictionController;
use App\Http\Controllers\Admin\UpcomingEventController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\MarqueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExclusiveController;
use App\Http\Controllers\SubmitOfferController;
use App\Http\Controllers\AboutController;
use App\Models\Admin\HelpFaq;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    return 'Application cache cleared!';
})->name('clear.cache');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/coupons', [HomeController::class, 'coupons'])->name('coupons');


Route::get('/event/{slug}', [EventsController::class, 'frontend'])->name('event.page');
Route::get('events', [EventsController::class, 'allevents'])->name('all-events');
Route::get('/store/{slug}', [StoresController::class, 'show'])->name('store.show');
Route::get('/search-store', [StoresController::class, 'searchStore'])->name('search.store');
Route::get('/search-store-ajax', [StoresController::class, 'searchStoreAjax'])
    ->name('search.store.ajax');
    
Route::get('/stores', [StoresController::class, 'browser'])->name('stores.page');
Route::get('/testview', function () {
    return view('testview');
});
Route::middleware(['geo.restrict'])->group(function () {
    Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
    Route::get('/help', [HelpFaqController::class, 'frontendHelp'])->name('help');  
});

Route::get('/blog/{slug}', [BlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [MessageController::class, 'index'])->name('contact');
Route::post('/contact/store', [MessageController::class, 'store'])->name('contact.store');
Route::get('/terms-of-service', [TermsSectionController::class, 'frontend'])->name('terms.page');

Route::get('/submit-coupon', [SubmitOfferController::class, 'index'])->name('submit.coupon');
Route::post('/submit-coupon', [SubmitOfferController::class, 'store'])->name('submit.coupon.store');
Route::get('/affiliate-disclosure', [AffiliateSectionController::class, 'frontend'])->name('affiliate.page');
Route::get('/disclaimer', [DisclaimerSectionController::class, 'frontend'])->name('disclaimer.page');
Route::get('/faqs', [FaqItemController::class, 'frontend'])->name('faq.page');
Route::get('/exclusive-discounts/{slug?}', [ExclusiveController::class, 'exclusive'])->name('exclusive.page');
Route::get('/privacy-policy', [PrivacySectionController::class, 'frontend'])->name('privacy.page');
Route::get('/upcoming-events', [UpcomingEventController::class, 'frontend'])->name('upcoming');
Route::get('/about', function () {
    return view('about');
});


Route::get('product', [ProductController::class, 'frontPage'])->name('front.product');
Route::get('/category', [CategoriesController::class, 'frontend'])->name('categories.page');
Route::get('/coupon-categories/{slug}', [CategoriesController::class, 'couponCategory'])->name('coupon_category.page');
Route::get('/coupon-categories', function () {
    return view('coupon-categories');
});
// Route::get('/broswer-coupon-cateory', function () {
//     return view('broswer-coupon-cateory');
// });

Route::match(['get', 'post'], 'login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/activity-report', [ReportController::class, 'activityReport'])->name('admin.activity.report');
    Route::prefix('categories')->name('categories.')->middleware('check_permission:category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::prefix('slider-images')->name('slider-images.')->middleware('check_permission:slider')->group(function(){
        Route::get('/', [SliderImageController::class, 'index'])->name('index');
        Route::post('/store', [SliderImageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SliderImageController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SliderImageController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SliderImageController::class, 'delete'])->name('delete');
    });

    Route::prefix('events')->name('events.')->middleware('check_permission:event')->group(function(){
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [EventController::class, 'destroy'])->name('delete');
    });

    Route::prefix('networks')->name('networks.')->middleware('check_permission:network')->group(function(){
        Route::get('/', [NetworkController::class, 'index'])->name('index');
        Route::get('/create', [NetworkController::class, 'create'])->name('create');
        Route::post('/store', [NetworkController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [NetworkController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [NetworkController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [NetworkController::class, 'destroy'])->name('delete');
        Route::get('/networks/{id}/details', [NetworkController::class, 'details'])->name('details');
    });

    Route::prefix('blog-posts')->name('blog-posts.')->middleware('check_permission:blog')->group(function(){
        Route::get('/', [BlogPostController::class, 'index'])->name('index');
        Route::get('/create', [BlogPostController::class, 'create'])->name('create');
        Route::post('/store', [BlogPostController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogPostController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BlogPostController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BlogPostController::class, 'destroy'])->name('delete');
    });

    Route::prefix('stores')->name('stores.')->middleware('check_permission:store')->group(function(){
        Route::get('/', [StoreController::class, 'index'])->name('index');
        Route::get('/create', [StoreController::class, 'create'])->name('create');
        Route::post('/store', [StoreController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [StoreController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [StoreController::class, 'destroy'])->name('delete');
        Route::post('/status/{id}', [StoreController::class, 'updateStatus'])->name('status');
    });

    Route::prefix('stores')->name('stores.')->middleware('check_permission:store_approval')->group(function(){
        Route::get('/pending', [StoreController::class, 'pendingStores'])->name('pending');
        Route::get('/completion-report',[StoreController::class, 'completionReport'])->name('completion.report');
        Route::post('/publish-store/{id}',[StoreController::class, 'publishStore'])->name('publish.store');
    });
    Route::get('stores/approval-stores',[StoreController::class, 'approvalStores'])->name('stores.approval.stores')->middleware('check_permission:store_report');

    Route::prefix('coupons')->name('coupons.')->middleware('check_permission:coupon')->group(function(){
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/store', [CouponController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CouponController::class, 'destroy'])->name('delete');
        Route::post('/status/{id}', [CouponController::class, 'updateStatus'])->name('status');
        Route::get('/active-by-store', [CouponController::class, 'activeByStore'])->name('active-by-store');
        Route::post('/votes/{id}', [CouponController::class, 'saveVotes'])->name('votes');
        Route::post('/sort', [CouponController::class, 'sortCoupons'])->name('sort');
    });

    Route::prefix('best-coupons')->name('best-coupons.')->middleware('check_permission:best_coupon')->group(function(){
        Route::get('/', [BestCouponController::class, 'index'])->name('index');
        Route::get('/create', [BestCouponController::class, 'create'])->name('create');
        Route::post('/store', [BestCouponController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BestCouponController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BestCouponController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BestCouponController::class, 'destroy'])->name('delete');
    });

    Route::prefix('general-faqs')->name('general-faqs.')->middleware('check_permission:store_general_faqs')->group(function(){
        Route::get('/', [GeneralFaqController::class, 'index'])->name('index');
        Route::get('/create', [GeneralFaqController::class, 'create'])->name('create');
        Route::post('/store', [GeneralFaqController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GeneralFaqController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GeneralFaqController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [GeneralFaqController::class, 'destroy'])->name('delete');
        Route::post('/status/{id}', [GeneralFaqController::class, 'updateStatus'])->name('status');
    });

    Route::prefix('theme-settings')->name('theme-settings.')->middleware('check_permission:theme_setting')->group(function(){
        Route::get('/', [ThemeSettingController::class, 'edit'])->name('edit');
        Route::post('/update', [ThemeSettingController::class, 'update'])->name('update');
    });

    Route::prefix('help-faqs')->name('help-faqs.')->middleware('check_permission:help')->group(function(){
        Route::get('/', [HelpFaqController::class, 'index'])->name('index');
        Route::get('/create', [HelpFaqController::class, 'create'])->name('create');
        Route::post('/store', [HelpFaqController::class, 'store'])->name('store');
        Route::get('/edit', [HelpFaqController::class, 'edit'])->name('edit');
        Route::post('/update', [HelpFaqController::class, 'update'])->name('update');
    });

    Route::prefix('terms')->name('terms.')->middleware('check_permission:term')->group(function(){
        Route::get('/', [TermsSectionController::class, 'index'])->name('index');
        Route::get('/create', [TermsSectionController::class, 'create'])->name('create');
        Route::post('/store', [TermsSectionController::class, 'store'])->name('store');
        Route::get('/edit', [TermsSectionController::class, 'editAll'])->name('editAll');
        Route::post('/update', [TermsSectionController::class, 'updateAll'])->name('updateAll');
    });

    Route::prefix('affiliate')->name('affiliate.')->middleware('check_permission:affiliate')->group(function(){
        Route::get('/', [AffiliateSectionController::class, 'index'])->name('index');
        Route::get('/create', [AffiliateSectionController::class, 'create'])->name('create');
        Route::post('/store', [AffiliateSectionController::class, 'store'])->name('store');
        Route::get('/edit', [AffiliateSectionController::class, 'editAll'])->name('editAll');
        Route::post('/update', [AffiliateSectionController::class, 'updateAll'])->name('updateAll');
    });

    Route::prefix('disclaimer')->name('disclaimer.')->middleware('check_permission:disclaimer')->group(function(){
        Route::get('/', [DisclaimerSectionController::class, 'index'])->name('index');
        Route::get('/create', [DisclaimerSectionController::class, 'create'])->name('create');
        Route::post('/store', [DisclaimerSectionController::class, 'store'])->name('store');
        Route::get('/edit', [DisclaimerSectionController::class, 'editAll'])->name('editAll');
        Route::post('/update', [DisclaimerSectionController::class, 'updateAll'])->name('updateAll');
    });

    Route::prefix('privacy')->name('privacy.')->middleware('check_permission:privacy')->group(function(){
        Route::get('/', [PrivacySectionController::class, 'index'])->name('index');
        Route::get('/create', [PrivacySectionController::class, 'create'])->name('create');
        Route::post('/store', [PrivacySectionController::class, 'store'])->name('store');
        Route::get('/edit', [PrivacySectionController::class, 'editAll'])->name('editAll');
        Route::post('/update', [PrivacySectionController::class, 'updateAll'])->name('updateAll');
    });

    Route::prefix('faqs')->name('faq.')->middleware('check_permission:faqs')->group(function(){
        Route::get('/', [FaqItemController::class, 'index'])->name('index');
        Route::get('/create', [FaqItemController::class, 'create'])->name('create');
        Route::post('/store', [FaqItemController::class, 'store'])->name('store');
        Route::get('/edit', [FaqItemController::class, 'editAll'])->name('editAll');
        Route::post('/update', [FaqItemController::class, 'updateAll'])->name('updateAll');
    });

    Route::prefix('submitted-offers')->name('submitted.offers.')->middleware('check_permission:submitted_offer')->group(function(){
        Route::get('/', [SubmittedOfferController::class, 'index'])->name('index');
        Route::delete('/delete/{id}', [SubmittedOfferController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user.')->middleware('check_permission:user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
        Route::match(['get', 'post'], '/activity', [UserLogController::class, 'index'])->name('activity');
        Route::match(['get', 'post'], '/activity/details/{id}', [UserLogController::class, 'details'])->name('activity.details');

    });
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');

    Route::prefix('product')->name('product.')->middleware('check_permission:product')->group(function(){
        Route::match(['get','post'], '/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');

        Route::get('/edit/{slug}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::get('/geo-restriction', [GeoRestrictionController::class, 'index'])->name('geo.index')->middleware('check_permission:geo_restriction');
    Route::post('/geo-restriction', [GeoRestrictionController::class, 'store'])->name('geo.store')->middleware('check_permission:geo_restriction');

    Route::prefix('upcoming-events')->name('upcoming-events.')->middleware('check_permission:upcoming_event')->group(function(){
        Route::get('/', [UpcomingEventController::class, 'index'])->name('index');
        Route::get('/create', [UpcomingEventController::class, 'create'])->name('create');
        Route::post('/store', [UpcomingEventController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UpcomingEventController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UpcomingEventController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UpcomingEventController::class, 'destroy'])->name('delete');
    });

    Route::prefix('setting')->name('setting.')->middleware('check_permission:site_setting')->group(function(){
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/save', [SettingController::class, 'save'])->name('store');
    });
    Route::prefix('messages')->name('messages.')->middleware('check_permission:message')->group(function(){
        Route::match(['get', 'post'], '/', [MessageController::class, 'ajax'])->name('ajax');
        Route::delete('/delete/{id}', [MessageController::class, 'delete'])->name('delete');
    });

    Route::prefix('marque')->name('marque.')->middleware('check_permission:marque')->group(function(){
        Route::get('/', [MarqueController::class, 'index'])->name('index');
        Route::post('/save', [MarqueController::class, 'save'])->name('save');
    });

    Route::match(['get', 'post'], '/home/page', [SettingController::class, 'homePage'])->name('home.page')->middleware('check_permission:home_setting');
    Route::match(['get', 'post'], '/home/page/popup', [SettingController::class, 'homePagePopup'])->name('home.page.popup')->middleware('check_permission:home_setting');

    Route::post('/ckeditor/upload', [SettingController::class, 'upload'])->name('ckeditor.upload');

});