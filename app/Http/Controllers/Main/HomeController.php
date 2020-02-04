<?php

namespace App\Http\Controllers\Main;


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

        return view('home', compact('animePost'));
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
            return view('errors.error')->withErrors(['msg' => "Пост {$anime} не найден"]);
        }
        $xfield = explode('||', $animePost['xfield']);

        foreach ($xfield as $value) {
            $xfields[] = explode('|', $value);
            foreach ($xfields as $key => $item) {
                $result[$item[0]] = $item[1];
            }
        }
        $animePost['xfield'] = $result;
        //dd(__METHOD__, $animePost, $xfields, $item,$result);

        return view('full_anime', compact('animePost'));
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
            return view('errors.error')->withErrors(['msg' => "Категория {$category} не найдена"]);
        }
        $animePost = self::$mainRepository->getCategoryAnimePost($categories, 10);

        return view('home', compact('animePost', 'categories'));
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
            return view('errors.error')->withErrors(['msg' => "Ничего не найдено"]);
        }
        return view('home', compact('animePost'));
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

        return view('home', compact('animePost'));
    }
}
