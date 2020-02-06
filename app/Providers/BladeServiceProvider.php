<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Providers;

use App\Helpers\Test;
use Blade;
use Illuminate\Support\ServiceProvider;
use Route;

class BladeServiceProvider extends ServiceProvider
{

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

    }
}
