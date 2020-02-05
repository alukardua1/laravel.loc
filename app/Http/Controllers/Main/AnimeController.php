<?php

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Главная страница аниме
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $animePost = self::$animeRepository->getAnime()->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }

    /**
     * Страница аниме поста
     *
     * @param $anime
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($anime)
    {
        $animePost = self::$animeRepository->getAnime($anime)->first();

        if (empty($animePost)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Пост {$anime} не найден"]);
        }

        return view(self::$theme.'/full_anime', compact('animePost'));
    }

//    /**
//     * Поиск по сайту
//     *
//     * @param  \Illuminate\Http\Request  $request
//     *
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function search(Request $request)
//    {
//        $animePost = self::$mainRepository->getSearch($request, 10);
//
//        if (empty($animePost)) {
//            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Ничего не найдено"]);
//        }
//        return view(self::$theme.'/home', compact('animePost'));
//    }
}
