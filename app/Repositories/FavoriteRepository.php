<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Repositories\Interfaces\FavoritesRepositoryInterface;
use Auth;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 */
class FavoriteRepository implements FavoritesRepositoryInterface
{
    /**
     * @param $id
     * @return mixed|void
     */
    public function favorite($id)
    {
        Auth::user()->favorites()->attach($id);
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function unFavorite($id)
    {
        Auth::user()->favorites()->detach($id);
    }
}
