<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Providers;

use App\Models\Anime;
use App\Models\Category;
use App\Models\User;
use App\Observers\AnimeObserver;
use App\Observers\CategoryObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        User::observe(UserObserver::class);
        Anime::observe(AnimeObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
