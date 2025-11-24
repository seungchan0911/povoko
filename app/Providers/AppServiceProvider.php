<?php

namespace App\Providers;

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
        // Deploy 시 storage link 자동 생성
        if (!file_exists(public_path('storage'))) {
            \Artisan::call('storage:link');
        }
    }
}
