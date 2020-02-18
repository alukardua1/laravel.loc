<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @return Factory|View|void
     */
    public function view($url)
    {
        $animePost = self::$categoryRepository
            ->getCategory($url)
            ->paginate(self::$paginate);

        if (\Cache::has('categories')) {
            $categories = \Cache::get('categories');
        } else {
            $categories = self::setCache(
                'categories',
                self::$categoryRepository
                    ->getCategory($url)
                    ->getParent()
            );
        }
        if (empty($animePost)) {
            return abort(404);
        }

        return view(self::$theme.'/home', compact('animePost', 'categories'));
    }
}
