<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        // Share the agenteId with all views
        if (Auth::check()) {
            $agenteId = Auth::user()->id;
            View::share('agenteId', $agenteId);
        } else {
            View::share('agenteId', null); // O otro valor por defecto si no hay usuario autenticado
        }
    }
}
