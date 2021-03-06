<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Traits\CreateCacheTrait;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class AnimeController
 *
 * @package App\Http\Controllers\Main
 */
class AnimeController extends Controller
{
    use CreateCacheTrait;

    /**
     * @var AnimeRepositoryInterface
     */
    private static $animeRepository;

    /**
     * @var CommentController|Application|mixed
     */
    private static $commentController;
    /**
     * @var string $keyCache ключ для создания кэша
     */
    private static $keyCache = 'anime_';

    /**
     * AnimeController constructor.
     *
     * @param AnimeRepositoryInterface $animeRepository репозиторий постов аниме
     */
    public function __construct(AnimeRepositoryInterface $animeRepository)
    {
        parent::__construct();
        self::$animeRepository = $animeRepository;
        self::$commentController = app(CommentController::class);
    }

    /**
     * Главная страница аниме
     *
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $page = 'page_' . $request->get('page', 1);
        if (Cache::has(self::$keyCache . $page)) {
            $animePost = Cache::get(self::$keyCache . $page);
        } else {
            $animePost = self::setCache(self::$keyCache . $page, self::$animeRepository->getAnime()->paginate(self::$paginate));
        }

        return view(self::$theme . '/home', compact('animePost'));
    }

    /**
     * Вывод поста аниме
     *
     * @param string $id
     * @param string $slug
     *
     * @return Application|Factory|RedirectResponse|Redirector|View|void
     */
    public function show($id, $slug = null)
    {
        if (Cache::has(self::$keyCache . $id)) {
            $animePost = Cache::get(self::$keyCache . $id);
        } else {
            $animePost = self::setCache(self::$keyCache . $id, self::$animeRepository->getAnime($id)->first());
        }

        if (empty($animePost)) {
            return abort(404);
        }

        $comm = self::$commentController->show($id);
        $animePost = self::currentRefactoring($animePost);

        if ($slug !== $animePost->url) {
            return redirect('/anime/' . $animePost->id . '-' . $animePost->url, 301);
        }

        return view(self::$theme . '/full_anime', compact('animePost', 'comm'));
    }

    /**
     * Поиск по сайту
     *
     * @param Request $request
     *
     * @return Factory|RedirectResponse|Redirector|View|void
     */
    public function search(Request $request)
    {
        $animePost = self::$animeRepository->getSearch($request)->paginate(self::$paginate);

        if (empty($animePost)) {
            return abort(404);
        }

        return view(self::$theme . '/home', compact('animePost'));
    }
}
