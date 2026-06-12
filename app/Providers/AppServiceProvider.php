<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Models\Guia;
use App\Observers\GuiaObserver;

=======
>>>>>>> origin/juana
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
<<<<<<< HEAD
        Guia::observe(GuiaObserver::class);
=======
        //
>>>>>>> origin/juana
    }
}
