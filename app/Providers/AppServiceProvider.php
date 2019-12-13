<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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

        \Schema::defaultStringLength(191);

        Blade::if('operator', function () {
            return operator();
        });
        Blade::if('master', function () {
            return master();
        });
        Blade::if('root', function () {
            return root();
        });
        Blade::if('notmaster', function () {
            return !master();
        });
        Blade::if('only_organ', function () {
            return only_organ();
        });
        Blade::if('organ', function () {
            return organ();
        });
    }
}
