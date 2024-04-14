<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Genre;

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
        View::composer('layouts.main-layout', function ($view) {
            $genres = Genre::all();
            $view->with('genres', $genres);
        });

        View::composer('layouts.nav-hidden-layout', function ($view) {
            $genres = Genre::all();
            $view->with('genres', $genres);
        });
    }
}
