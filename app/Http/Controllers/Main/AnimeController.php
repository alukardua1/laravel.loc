<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class AnimeController
 *
 * @package App\Http\Controllers\Main
 */
class AnimeController extends Controller
{
    /**
     * @var AnimeRepositoryInterface
     */
    private static $animeRepository;

    /**
     * AnimeController constructor.
     *
     * @param AnimeRepositoryInterface $repository
     */
    public function __construct(AnimeRepositoryInterface $repository)
    {
        parent::__construct();
        self::$animeRepository = $repository;
    }

    /**
     * Главная страница аниме
     *
     * @return Renderable
     */
    public function index()
    {
        $animePost = self::$animeRepository->getAnime()->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }

    /**
     * Страница аниме поста
     *
     * @param $urlAnime
     *
     * @return mixed \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($urlAnime)
    {

        $uri = explode('-', $urlAnime);
        $stringUrl = preg_split("/[0-9]+-/", $urlAnime);

        $animePost = self::$animeRepository->getAnime($uri[0])->first();
        if (empty($animePost)) {
            //return view(self::$theme.'/errors.error')->withErrors(['msg' => "Пост {$urlAnime} не найден"]);
            return abort(404);
        }

        if ($stringUrl[1] != $animePost->url) {

            return redirect('/anime/'.$animePost->id.'-'.$animePost->url);
        }

        return view(self::$theme.'/full_anime', compact('animePost'));
    }

    /**
     * Поиск по сайту
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function search(Request $request)
    {
        $animePost = self::$animeRepository->getSearch($request)->paginate(self::$paginate);

        if (empty($animePost)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Ничего не найдено"]);
        }
        return view(self::$theme.'/home', compact('animePost'));
    }
}
