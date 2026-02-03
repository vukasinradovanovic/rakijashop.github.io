<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardQuestionsController;
use App\Http\Controllers\Dashboard\DashboardSearchStatsController;
use App\Http\Controllers\Dashboard\DashboardUsersController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

//Middleware for admin users domain
Route::middleware('isAdmin')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('dashboard-questions', DashboardQuestionsController::class);
    Route::resource('dashboard-users', DashboardUsersController::class);
    Route::resource('dashboard-search-stats', DashboardSearchStatsController::class);
    Route::get('/dashboardUsers/search', [DashboardUsersController::class, 'search']);
    Route::post('/dashboardQuestions/{question}/mark-as-read', [DashboardQuestionsController::class, 'markAsRead'])->name('dashboard-questions.mark-as-read');
});

Route::resource('user', UserController::class);
Route::resource('product', ProductController::class);

Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [PagesController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
