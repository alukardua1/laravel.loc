<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Main
 */
class CategoryController extends Controller
{
    /**
     * @var string $keyCache ключ для создания кэша
     */
    private static $keyCache = 'categories';

    /**
     * Выводит аниме по категориям
     *
     * @param string $url
     *
     * @return Factory|View|void
     */
    public function show($url)
    {
        $animePost = self::$categoryRepository
            ->getCategory($url)
            ->paginate(self::$paginate);

        if (Cache::has(self::$keyCache)) {
            $categories = Cache::get(self::$keyCache);
        } else {
            $categories = self::setCache(self::$keyCache, self::$categoryRepository->getCategory($url)->getParent());
        }

        if (empty($animePost)) {
            return abort(404);
        }

        return view(self::$theme . '/home', compact('animePost', 'categories'));
    }
}
