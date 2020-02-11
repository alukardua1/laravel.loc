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
use App\Repositories\Interfaces\CountryRepositoryInterface;
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
     * @var CategoryRepositoryInterface
     */
    protected static $categoryRepository;

    /**
     * @var AnimeRepositoryInterface
     */
    private static $animeRepository;

    /**
     * @var CountryRepositoryInterface
     */
    protected static $countryRepository;

    /**
     * AdminAnimeController constructor.
     *
     * @param  \App\Repositories\Interfaces\AnimeRepositoryInterface     $animeRepository
     * @param  \App\Repositories\Interfaces\CategoryRepositoryInterface  $categoryRepository
     * @param  \App\Repositories\Interfaces\CountryRepositoryInterface   $countryRepository
     */
    public function __construct(
        AnimeRepositoryInterface $animeRepository,
        CategoryRepositoryInterface $categoryRepository,
        CountryRepositoryInterface $countryRepository
    ) {
        parent::__construct();
        self::$categoryRepository = $categoryRepository;
        self::$animeRepository = $animeRepository;
        self::$countryRepository = $countryRepository;
    }

    /**
     * Главная страница всех записей аниме
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @uses \App\Http\Controllers\Administrations\AdminBaseController::$paginate
     * @var $animePost
     */
    public function index()
    {
        $animePost = self::$animeRepository->getAnime(null, true)->paginate(self::$paginate);

        return view('admin.anime.index', compact('animePost'));
    }

    /**
     * Страница редактирования аниме
     *
     * @param $animeUrl
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @uses \App\Helpers\FunctionsHelpers::$arrTip
     * @uses \App\Helpers\FunctionsHelpers::$arrRatings
     * @uses \App\Repositories\CategoryRepository
     * @uses \App\Repositories\AnimeRepository
     *
     * @var   $tip
     * @var   $rating
     * @var   $category
     * @var   $animePost
     */
    public function edit($animeUrl)
    {
        $tip = FunctionsHelpers::$arrTip;
        $rating = FunctionsHelpers::$arrRatings;
        $category = self::$categoryRepository->getCategory()->get();
        $animePost = self::$animeRepository->getAnime($animeUrl)->first();
        $country = self::$countryRepository->getCountry(['id', 'title']);

        return view('admin.anime.edit', compact('animePost', 'category', 'tip', 'rating', 'country'));
    }

    public function create()
    {
        $tip = FunctionsHelpers::$arrTip;
        $rating = FunctionsHelpers::$arrRatings;
        $category = self::$categoryRepository->getCategory()->get();
        $country = self::$countryRepository->getCountry(['id', 'title']);

        return view('admin.anime.add', compact('category', 'tip', 'rating', 'country'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $updateAnime = self::$animeRepository->setAnime($request);
        if ($updateAnime) {
            return redirect()->route('admin.anime');
        }
        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }


    /**
     * Процедура обновления записи
     *
     * @param  \Illuminate\Http\Request  $request
     * @param                            $animeUrl
     *
     * @return \Illuminate\Http\RedirectResponse
     * @var                              $updateAnime
     *
     */
    public function update(Request $request, $animeUrl): \Illuminate\Http\RedirectResponse
    {
        //dd(__METHOD__, $request);
        $updateAnime = self::$animeRepository->setAnime($request, $animeUrl);
        if ($updateAnime) {
            return redirect()->route('admin.anime.edit', $animeUrl);
        }
        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }

    public function delete($animeUrl)
    {
        $updateAnime = self::$animeRepository->delAnime($animeUrl);
        if ($updateAnime) {
            return redirect()->route('admin.anime');
        }
        return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
    }
}
