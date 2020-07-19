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

/**
 * Class FavoriteController
 *
 * @package App\Http\Controllers\Main
 */
class FavoriteController extends Controller
{
    /**
     * @var FavoritesRepositoryInterface $favoriteRepository
     */
    private static $favoriteRepository;

    /**
     * FavoriteController constructor.
     *
     * @param FavoritesRepositoryInterface $favoritesRepository
     */
    public function __construct(FavoritesRepositoryInterface $favoritesRepository)
    {
        parent::__construct();
        self::$favoriteRepository = $favoritesRepository;
    }

    /**
     * Добавить в закладки
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function add($id): RedirectResponse
    {
        self::$favoriteRepository->favorite($id);

        return back();
    }

    /**
     * Убрать из закладок
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        self::$favoriteRepository->unFavorite($id);

        return back();
    }
}
