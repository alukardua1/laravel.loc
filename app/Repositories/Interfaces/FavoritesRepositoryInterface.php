<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


interface FavoritesRepositoryInterface
{
public function favorite($id);

public function unFavorite($id);
}
