<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    ProfileSettingController,
    LogoutController,
    DestinationController,
    AdminSettingController,
    SeoSettingController,
    AttractionController,
    LocationController,
    HotelController,
    CategoryController

};

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;


// ── (unchanged — front + customer routes, no admin permission needed here) ──
Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/category/{slug}', 'categoryDetail')->name('category.show');
    Route::get('/destinations', 'destinations')->name('destinations');
    Route::get('/destination/{slug}', 'destinationDetail')->name('destination.show');
    Route::get('/attractions', 'attractions')->name('attractions');
    Route::get('/attraction/{slug}', 'attractionDetail')->name('attraction.show');
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
        Route::get('destinations/states/{country}', [DestinationController::class, 'getStates'])->name('destinations.states');
        Route::get('destinations/cities/{state}', [DestinationController::class, 'getCities'])->name('destinations.cities');

        Route::resource('attractions', AttractionController::class);
        Route::get('attractions/states/{country}', [AttractionController::class, 'getStates'])->name('attractions.states');
        Route::get('attractions/cities/{state}', [AttractionController::class, 'getCities'])->name('attractions.cities');

        Route::resource('hotels', HotelController::class);
        Route::resource('categories', CategoryController::class);

        // Admin Settings routes
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/general', [AdminSettingController::class, 'generalSettingStore'])->name('settings.general');
        Route::post('/settings/smtp', [AdminSettingController::class, 'smtpSettingStore'])->name('settings.smtp');
        Route::post('/settings/google', [AdminSettingController::class, 'googleSettingStore'])->name('settings.google');
        Route::post('/settings/sms', [AdminSettingController::class, 'smsSettingStore'])->name('settings.sms');
        Route::post('/settings/sms/test', [AdminSettingController::class, 'smsSettingTest'])->name('settings.sms.test');

        Route::prefix('seo-setting')->name('seo-setting.')->group(function () {
            Route::get('/', [SeoSettingController::class, 'index'])->name('index');
            Route::get('{seo_setting}/edit', [SeoSettingController::class, 'edit'])->name('edit');
            Route::put('{seo_setting}', [SeoSettingController::class, 'update'])->name('update');
        });

    });

});
