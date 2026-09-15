<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    ProfileSettingController,
    LogoutController,
    DestinationController,
    ActivityController,
    AdminSettingController,
    SeoSettingController,
    AttractionCategoryController,
    AttractionController,
    LocationController,
    HotelController,
    CategoryController,
    SubCategoryController,
    TourPackageController,
    ReviewController,
    ActivityCategoryController,
    TourPackageEnquiryController,
    LandingPageActivityController,
    LandingPageDestinationController,
    LandingPageAttractionController
};

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;


// ── (unchanged — front + customer routes, no admin permission needed here) ──
Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'home')->name('home');

    Route::get('/category/{slug}', 'categoryDetail')->name('category.show');
    Route::get('/subcategory/{slug}', 'subcategoryDetail')->name('subcategory.show');
    Route::get('/tour-package/{slug}', 'tourPackageDetail')->name('tourpackage.show');

    Route::get('/destinations', 'destinations')->name('destinations');
    Route::get('/destination/{slug}', 'destinationDetail')->name('destination.show');

    Route::get('/attractions', 'attractions')->name('attractions');
    Route::get('/attraction/{slug}', 'attractionDetail')->name('attraction.show');

    Route::get('/activities', 'activities')->name('activities');
    Route::get('/activities/{slug}', 'activitiesDetail')->name('activities.show');


    Route::post('/reviews', 'reviewStore')->name('review.store');
    Route::post('/enquiries', 'enquiryStore')->name('enquiries.store');
});


// Admin Routes list
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/get-cities', [AdminSettingController::class, 'getCities'])->name('get-cities');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth'])->group(function () {

        // ── Personal / no permission needed ──
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/profile-setting', ProfileSettingController::class);
        Route::post('/resetpassword', [ProfileSettingController::class, 'resetPassword'])->name('reset.password');
        Route::get('/logout', [LogoutController::class, 'logout']);

        Route::get('location/states/{country}', [LocationController::class, 'getStates'])->name('location.states');
        Route::get('location/cities/{state}', [LocationController::class, 'getCities'])->name('location.cities');

        Route::resource('destinations', DestinationController::class);
        Route::resource('attraction-categories', AttractionCategoryController::class);
        Route::resource('attractions', AttractionController::class);
        Route::resource('activity-categories', ActivityCategoryController::class);
        Route::resource('activities', ActivityController::class);

        Route::resource('hotels', HotelController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubCategoryController::class);
        Route::resource('tourpackages', TourPackageController::class);

        Route::resource('reviews', ReviewController::class);
        Route::get('reviews/entities/{type}', [ReviewController::class, 'entitiesByType'])->name('reviews.entities');

        Route::get('landing-pages/activities', [LandingPageActivityController::class, 'edit'])->name('landing-pages.activities.edit');
        Route::put('landing-pages/activities', [LandingPageActivityController::class, 'update'])->name('landing-pages.activities.update');

        Route::get('landing-pages/destination', [LandingPageDestinationController::class, 'edit'])->name('landing-pages.destination.edit');
        Route::put('landing-pages/destination', [LandingPageDestinationController::class, 'update'])->name('landing-pages.destination.update');

        Route::get('landing-pages/attraction', [LandingPageAttractionController::class, 'edit'])->name('landing-pages.attraction.edit');
        Route::put('landing-pages/attraction', [LandingPageAttractionController::class, 'update'])->name('landing-pages.attraction.update');

        // Admin Settings routes
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/general', [AdminSettingController::class, 'generalSettingStore'])->name('settings.general');
        Route::post('/settings/smtp', [AdminSettingController::class, 'smtpSettingStore'])->name('settings.smtp');
        Route::post('/settings/google', [AdminSettingController::class, 'googleSettingStore'])->name('settings.google');
        Route::post('/settings/sms', [AdminSettingController::class, 'smsSettingStore'])->name('settings.sms');
        Route::post('/settings/sms/test', [AdminSettingController::class, 'smsSettingTest'])->name('settings.sms.test');

        Route::resource('package-enquiries', TourPackageEnquiryController::class)->only(['index', 'show', 'destroy']);
        Route::patch('package-enquiries/{package_enquiry}/status', [TourPackageEnquiryController::class, 'updateStatus'])->name('package-enquiries.status');

        Route::prefix('seo-setting')->name('seo-setting.')->group(function () {
            Route::get('/', [SeoSettingController::class, 'index'])->name('index');
            Route::get('{seo_setting}/edit', [SeoSettingController::class, 'edit'])->name('edit');
            Route::put('{seo_setting}', [SeoSettingController::class, 'update'])->name('update');
        });

    });

});
