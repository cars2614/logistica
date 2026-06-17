<?php

namespace App\Providers;

use App\Models\Guia;
use App\Observers\GuiaObserver;
use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

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
        Guia::observe(GuiaObserver::class);
        Model::preventLazyLoading(! app()->isProduction());
        
        // Configurar paginación de Laravel para usar Bootstrap (Corrige iconos gigantes SVG)
        Paginator::useBootstrap();
    }
}
