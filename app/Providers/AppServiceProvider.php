<?php

namespace App\Providers;

use App\Http\Controllers\Localization\LocalizationController;
use App\Models\Company\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('companyInfo', CompanyInfo::first());

        View::composer('components.header.nav', function ($view): void {
            $localizationController = app(LocalizationController::class);
            $request = app(Request::class);

            $view->with('localization', $localizationController->buildNavigationLocalization($request));
        });
    }
}
