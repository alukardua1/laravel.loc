<?php

namespace App\Providers;

use App\Helpers\Test;
use Blade;
use Illuminate\Support\ServiceProvider;
use Route;

class BladeServiceProvider extends ServiceProvider
{
    use Test;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('available', function ($expression) {
            $routeName = explode('|', $expression);

            return in_array(Route::currentRouteName(), $routeName, true);
        });

        Blade::directive('custom', function ($expression) {
            $test = $this->test($expression);

            return $test;
        });

    }
}
