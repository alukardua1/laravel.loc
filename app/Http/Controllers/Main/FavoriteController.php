<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\FavoritesRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller
{
    private static $favoriteRepository;

    public function __construct(FavoritesRepositoryInterface $repository)
    {
        parent::__construct();
        self::$favoriteRepository = $repository;
    }

    /**
     * Добавить в закладки
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function favorite($id): RedirectResponse
    {
        self::$favoriteRepository->favorite($id);

        return back();
    }

    /**
     * Убрать из закладок
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function unFavorite($id): RedirectResponse
    {
        self::$favoriteRepository->unFavorite($id);
        return back();
    }
}
