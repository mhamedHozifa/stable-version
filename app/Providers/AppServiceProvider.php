<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\ThemeResolver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\Cart::class);
        $this->app->singleton(ThemeResolver::class, function () {
            return new ThemeResolver();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share the current site type with all views.
        View::share('siteType', Setting::get('site_type', 'clothing'));
        View::share('themeResolver', app(ThemeResolver::class));
    }
}
