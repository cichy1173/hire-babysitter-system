<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Advertisement;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::if('admin', function() {
            return auth()->check() && auth()->user()->id_account_type == '3';
        });

        Advertisement::disableSearchSyncing();
        User::disableSearchSyncing();
    }
}
