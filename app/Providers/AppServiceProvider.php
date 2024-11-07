<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\UserLayout;
use Illuminate\Support\Facades\Blade;
use App\Models\State;

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
        view()->share('states', State::all());
        Blade::component('user-layout', UserLayout::class);
    }
}
