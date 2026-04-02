<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardCategoryProductsController;
use App\Http\Controllers\Dashboard\DashboardProductsController;
use App\Http\Controllers\Dashboard\DashboardQuestionsController;
use App\Http\Controllers\Dashboard\DashboardUsersController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Question\QuestionController;
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

    // Dashboard users routes (explicit instead of resource)
    Route::get('/dashboard-users', [DashboardUsersController::class, 'index'])->name('dashboard-users.index');
    Route::get('/dashboard-users/create', [DashboardUsersController::class, 'create'])->name('dashboard-users.create');
    Route::post('/dashboard-users', [DashboardUsersController::class, 'store'])->name('dashboard-users.store');

    Route::get('/dashboard-users/data', [DashboardUsersController::class, 'data'])->name('dashboard-users.data');
    Route::get('/dashboard-users/search', [DashboardUsersController::class, 'search'])->name('dashboard-users.search');

    Route::get('/dashboard-users/{dashboard_user}', [DashboardUsersController::class, 'show'])->name('dashboard-users.show');
    Route::get('/dashboard-users/{dashboard_user}/edit', [DashboardUsersController::class, 'edit'])->name('dashboard-users.edit');
    Route::put('/dashboard-users/{dashboard_user}', [DashboardUsersController::class, 'update'])->name('dashboard-users.update');
    Route::patch('/dashboard-users/{dashboard_user}', [DashboardUsersController::class, 'update']);
    Route::delete('/dashboard-users/{dashboard_user}', [DashboardUsersController::class, 'destroy'])->name('dashboard-users.destroy');

    // Dashboard products routes (explicit instead of resource)
    Route::get('/dashboard-products', [DashboardProductsController::class, 'index'])->name('dashboard-products.index');
    Route::get('/dashboard-products/search', [DashboardProductsController::class, 'search'])->name('dashboard-products.search');
    Route::put('/dashboard-products/{dashboard_product}', [DashboardProductsController::class, 'update'])->name('dashboard-products.update');
    Route::patch('/dashboard-products/{dashboard_product}', [DashboardProductsController::class, 'update']);

    // Dashboard product categories routes
    Route::get('/dashboard-category-products', [DashboardCategoryProductsController::class, 'index'])->name('dashboard-category-products.index');
    Route::get('/dashboard-category-products/search', [DashboardCategoryProductsController::class, 'search'])->name('dashboard-category-products.search');
    Route::post('/dashboard-category-products', [DashboardCategoryProductsController::class, 'store'])->name('dashboard-category-products.store');
    Route::put('/dashboard-category-products/{dashboard_category_product}', [DashboardCategoryProductsController::class, 'update'])->name('dashboard-category-products.update');
    Route::patch('/dashboard-category-products/{dashboard_category_product}', [DashboardCategoryProductsController::class, 'update']);
    Route::delete('/dashboard-category-products/{dashboard_category_product}', [DashboardCategoryProductsController::class, 'destroy'])->name('dashboard-category-products.destroy');

    // Dashboard questions/contact routes
    Route::resource('dashboard-questions', DashboardQuestionsController::class);
    Route::post('/dashboardQuestions/{question}/mark-as-read', [DashboardQuestionsController::class, 'markAsRead'])->name('dashboard-questions.mark-as-read');
});

// Localized routes group
Route::prefix('{locale}')
    ->whereIn('locale', ['en', 'sr'])
    ->middleware('setLocale')
    ->group(function () {
        // Middleware for authenticated users domain
        Route::middleware('auth')->group(function () {
            Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
            Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
            Route::patch('/user/{user}', [UserController::class, 'update']);
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::resource('product', ProductController::class);

        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

        Route::get('/', [PagesController::class, 'index'])->name('index');

        // Other pages section
        Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
        Route::post('/contact', [QuestionController::class, 'store'])->name('contact.store');

        // Authentication routes for guests
        Route::middleware('guest')->group(function () {
            Route::get('/login', [PagesController::class, 'login'])->name('login');
            Route::post('/login', [AuthController::class, 'login']);

            Route::get('/register', [PagesController::class, 'register'])->name('register');
            Route::post('/register', [AuthController::class, 'register']);
        });
    });
