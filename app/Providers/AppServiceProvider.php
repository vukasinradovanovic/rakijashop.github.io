<?php

namespace App\Providers;

use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Localization\LocalizationController;
use App\Models\Company\CompanyInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        
        try {
            $companyInfo = CompanyInfo::first();
        } catch (Throwable) {
            $companyInfo = null;
        }

        View::share('companyInfo', $companyInfo);

        View::composer('components.header.nav', function ($view): void {
            $localizationController = app(LocalizationController::class);
            $request = app(Request::class);
            $cartQuantity = CartController::getCartQuantity();

            $view->with('localization', $localizationController->buildNavigationLocalization($request));
            $view->with('cartQuantity', $cartQuantity);
        });
    }
}
