<?php

namespace App\Providers;


use App\Models\Gallery;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
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
        // Vite::prefetch(concurrency: 3);

        View::composer('home', function ($view) {
        $view->with(
            'homeGalleries',
            Gallery::whereNotNull('image')
                ->latest()
                ->take(6)
                ->get()
        );
    });

        Paginator::useBootstrap(5);

    }
}
