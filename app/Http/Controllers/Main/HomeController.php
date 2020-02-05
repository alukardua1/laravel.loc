<?php

namespace App\Http\Controllers\Main;


use App\Helpers\FunctionsHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Главная страница
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $animePost = self::$mainRepository->getAllAnimePost(10);

        return view(self::$theme.'/home', compact('animePost'));
    }

    /**
     * Страница аниме поста
     *
     * @param $anime
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anime($anime)
    {
        $animePost = self::$mainRepository->getFullAnime($anime);
        if (empty($animePost)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Пост {$anime} не найден"]);
        }

        $kind = FunctionsHelpers::$arrRating;

        return view(self::$theme.'/full_anime', compact('animePost', 'kind'));
    }

    /**
     * Страница категории
     *
     * @param $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory($category)
    {
        $categories = self::$mainRepository->getCategory($category);
        if (empty($categories)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Категория {$category} не найдена"]);
        }
        $animePost = self::$mainRepository->getCategoryAnimePost($categories, 10);

        return view(self::$theme.'/home', compact('animePost', 'categories'));
    }

    /**
     * Поиск по сайту
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $animePost = self::$mainRepository->getSearch($request, 10);

        if (empty($animePost)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Ничего не найдено"]);
        }
        return view(self::$theme.'/home', compact('animePost'));
    }

    /**
     * Вывод кустом
     *
     * @param $custom
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function custom($custom)
    {
        $animePost = self::$mainRepository->getCustom('kind', $custom, 10);

        return view(self::$theme.'/home', compact('animePost'));
    }
}
