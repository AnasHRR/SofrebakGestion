<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $expiredFactures = \App\Models\Factures::where('date_echeance', '<', \Carbon\Carbon::now()->toDateString())
                ->where('statut', '!=', 'Payée')
                ->whereNotNull('date_echeance')
                ->orderBy('date_echeance', 'desc')
                ->take(10)
                ->get();
            $view->with('expiredFactures', $expiredFactures);
        });
    }
}
