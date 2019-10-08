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
            $user = auth()->user();
            return $user && ($user->type == 'operator' || $user->type == 'master');
        });
        Blade::if('master', function () {
            $user = auth()->user();
            return $user && $user->type == 'master';
        });
        Blade::if('onlyorgan', function () {
            $user = auth()->user();
            return $user && $user->type == 'organ';
        });
    }
}
