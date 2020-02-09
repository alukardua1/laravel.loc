<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Helpers\FunctionsHelpers;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class AdminAnimeController
 *
 * @package App\Http\Controllers\Administrations
 */
class AdminAnimeController extends AdminBaseController
{
    use FunctionsHelpers;
    /**
     * @var \App\Repositories\CategoryRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $categoryRepository;
    /**
     * @var \App\Repositories\Interfaces\AnimeRepositoryInterface
     */
    private static $animeRepository;

    /**
     * AdminAnimeController constructor.
     *
     * @param  \App\Repositories\Interfaces\AnimeRepositoryInterface  $repository
     */
    public function __construct(AnimeRepositoryInterface $repository)
    {
        parent::__construct();
        self::$categoryRepository = app(CategoryRepositoryInterface::class);
        self::$animeRepository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $animePost = self::$animeRepository->getAnime(null, true)->paginate(self::$paginate);

        return view('admin.anime.index', compact('animePost'));
    }

    /**
     * @param $animeUrl
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($animeUrl)
    {
        $tip = FunctionsHelpers::$arrTip;
        $category = self::$categoryRepository->getCategory()->get();
        $animePost = self::$animeRepository->getAnime($animeUrl)->first();

        return view('admin.anime.edit', compact('animePost', 'category', 'tip'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param                            $animeUrl
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $animeUrl): \Illuminate\Http\RedirectResponse
    {
        $updateAnime = self::$animeRepository->setAnime($request, $animeUrl);
        if ($updateAnime) {
            return redirect()->route('admin.anime.edit', $animeUrl);
        }
        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }
}
