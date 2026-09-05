<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    ProfileSettingController,
    LogoutController,
    DestinationController

};

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;


// ── (unchanged — front + customer routes, no admin permission needed here) ──
Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'destinations')->name('home');
    Route::get('/destinations', 'destinations')->name('destinations');
    Route::get('/destination/{destination}',  'destinationDetail')->name('destination.show');
});


// Admin Routes list
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth'])->group(function () {

        // ── Personal / no permission needed ──
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/profile-setting', ProfileSettingController::class);
        Route::post('/resetpassword', [ProfileSettingController::class, 'resetPassword'])->name('reset.password');
        Route::get('/logout', [LogoutController::class, 'logout']);

        Route::resource('destinations', DestinationController::class);

        // Cascading dropdown endpoints (Country -> State -> City)
        Route::get('destinations/states/{country}', [DestinationController::class, 'getStates'])
            ->name('destinations.states');

        Route::get('destinations/cities/{state}', [DestinationController::class, 'getCities'])
            ->name('destinations.cities');

    });

});
