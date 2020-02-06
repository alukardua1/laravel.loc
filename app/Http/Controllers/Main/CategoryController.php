<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($url)
    {
        $animePost = self::$categoryRepository->getCategory($url)->paginate(self::$paginate);
        $categories = self::$categoryRepository->getCategory($url)->getParent();

        if (empty($animePost)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Категория {$url} не найдена"]);
        }

        return view(self::$theme.'/home', compact('animePost', 'categories'));
    }
}
