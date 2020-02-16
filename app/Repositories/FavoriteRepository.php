<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Repositories\Interfaces\FavoritesRepositoryInterface;
use Auth;

class FavoriteRepository implements FavoritesRepositoryInterface
{
    public function favorite($id)
    {
        Auth::user()->favorites()->attach($id);

        //return back();
    }

    public function unFavorite($id)
    {
        Auth::user()->favorites()->detach($id);

       // return back();
    }
}
