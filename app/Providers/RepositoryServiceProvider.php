<?php

namespace App\Providers;


use App\Repositories\Interfaces\MainRepositoryInterface;
use App\Repositories\MainRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MainRepositoryInterface::class,
            MainRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
