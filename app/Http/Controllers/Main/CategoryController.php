<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Cache;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Main
 */
class CategoryController extends Controller
{

    /**
     * Выводит аниме по категориям
     *
     * @param $url
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function view($url)
    {
        $animePost = self::$categoryRepository
            ->getCategory($url)
            ->paginate(self::$paginate);

        $categories = self::getCache('categories', self::$categoryRepository->getCategory($url)->getParent());

        if (empty($animePost)) {
            return abort(404);
        }

        return view(self::$theme.'/home', compact('animePost', 'categories'));
    }
}
