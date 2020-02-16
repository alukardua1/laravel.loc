<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Providers;


use App\Repositories\AnimeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CharacterRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CustomRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CharacterRepositoryInterface;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\CustomRepositoryInterface;
use App\Repositories\Interfaces\FavoritesRepositoryInterface;
use App\Repositories\Interfaces\PeopleRepositoryInterface;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;
use App\Repositories\Interfaces\TranslateRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VoteRepositoryInterface;
use App\Repositories\PeopleRepository;
use App\Repositories\StaticPageRepository;
use App\Repositories\TranslateRepository;
use App\Repositories\UserRepository;
use App\Repositories\VoteRepository;
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
            AnimeRepositoryInterface::class,
            AnimeRepository::class
        );
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            CharacterRepositoryInterface::class,
            CharacterRepository::class
        );
        $this->app->bind(
            CommentsRepositoryInterface::class,
            CommentsRepository::class
        );
        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );
        $this->app->bind(
            CustomRepositoryInterface::class,
            CustomRepository::class
        );
        $this->app->bind(
            PeopleRepositoryInterface::class,
            PeopleRepository::class
        );
        $this->app->bind(
            StaticPageRepositoryInterface::class,
            StaticPageRepository::class
        );
        $this->app->bind(
            TranslateRepositoryInterface::class,
            TranslateRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            FavoritesRepositoryInterface::class,
            FavoriteRepository::class
        );
        $this->app->bind(
            VoteRepositoryInterface::class,
            VoteRepository::class
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
