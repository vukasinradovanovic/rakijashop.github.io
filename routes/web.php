<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardSearchStatsController;
use App\Http\Controllers\Dashboard\DashboardUsersController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $preferred = $request->getPreferredLanguage(['sr', 'en']) ?? config('app.fallback_locale', 'en');

    return redirect()->route('index', ['locale' => $preferred]);
})->name('home');

// Middleware for admin users domain
Route::middleware('isAdmin')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('dashboard-users', DashboardUsersController::class);
    Route::get('/dashboardUsers/search', [DashboardUsersController::class, 'search']);
});

// Localized routes group
Route::prefix('{locale}')
    ->whereIn('locale', ['en', 'sr'])
    ->middleware('setLocale')
    ->group(function () {
        // Middleware for authenticated users domain
        Route::middleware('auth')->group(function () {
            Route::resource('user', UserController::class);
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::resource('product', ProductController::class);

        Route::get('/', [PagesController::class, 'index'])->name('index');

        // Other pages section
        Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
        Route::get('/contact', [PagesController::class, 'contact'])->name('contact');

        // Authentication routes for guests
        Route::middleware('guest')->group(function () {
            Route::get('/login', [PagesController::class, 'login'])->name('login');
            Route::post('/login', [AuthController::class, 'login']);

            Route::get('/register', [PagesController::class, 'register'])->name('register');
            Route::post('/register', [AuthController::class, 'register']);
        });
    });
