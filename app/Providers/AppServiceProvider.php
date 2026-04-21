<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        /**
         * 1. Database Compatibility
         * Prevents "Specified key was too long" errors during migrations.
         */
        Schema::defaultStringLength(191);

        /**
         * 2. Global View Variables (CraveCart Branding)
         * You can now use these in any Blade file like this: 
         * <body style="background-color: {{ $bgCream }};">
         * <button style="background-color: {{ $brandColor }};">Click Me</button>
         */
        View::share('brandColor', '#dd0d22'); // Your Primary Red
        View::share('bgCream', '#f3e3cb');   // Your Retro Cream Background
    }
}