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
use App\Repositories\Interfaces\TranslateRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @var TranslateRepositoryInterface
     */
    protected static $translateRepository;

    /**
     * AdminAnimeController constructor.
     *
     * @param  AnimeRepositoryInterface      $animeRepository
     * @param  CategoryRepositoryInterface   $categoryRepository
     * @param  CountryRepositoryInterface    $countryRepository
     * @param  TranslateRepositoryInterface  $translateRepository
     */
    public function __construct(
        AnimeRepositoryInterface $animeRepository,
        CategoryRepositoryInterface $categoryRepository,
        CountryRepositoryInterface $countryRepository,
        TranslateRepositoryInterface $translateRepository
    ) {
        parent::__construct();
        self::$categoryRepository = $categoryRepository;
        self::$animeRepository = $animeRepository;
        self::$countryRepository = $countryRepository;
        self::$translateRepository = $translateRepository;
    }

    /**
     * Главная страница всех записей аниме
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @var $animePost
     * @uses \App\Http\Controllers\Administrations\AdminBaseController::$paginate
     */
    public function index()
    {
        $animePost = self::$animeRepository->getAnime(null, true)->paginate(self::$paginate);

        return view('admin.anime.index', compact('animePost'));
    }

    /**
     * Страница редактирования аниме
     *
     * @param     $animeUrl
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @var array $tip
     * @var array $rating
     * @var mixed $category
     * @var mixed $animePost
     * @uses \App\Helpers\FunctionsHelpers::$arrTip
     * @uses \App\Helpers\FunctionsHelpers::$arrRatings
     * @uses \App\Repositories\CategoryRepository
     * @uses \App\Repositories\AnimeRepository
     *
     */
    public function edit($animeUrl)
    {
        $tip = FunctionsHelpers::$arrTip;
        $rating = FunctionsHelpers::$arrRatings;
        $category = self::$categoryRepository->getCategory()->get();
        $animePost = self::$animeRepository->getAnime($animeUrl)->first();
        $country = self::$countryRepository->getCountry(['id', 'title']);
        $translate = self::$translateRepository->getTranslate();

        return view('admin.anime.edit', compact('animePost', 'category', 'tip', 'rating', 'country', 'translate'));
    }

    /**
     * Добавление нового поста
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @var array $rating
     * @var mixed $category
     * @var mixed $animePost
     * @var array $tip
     * @uses \App\Helpers\FunctionsHelpers::$arrRatings
     * @uses \App\Repositories\CategoryRepository
     * @uses \App\Repositories\AnimeRepository
     *
     * @uses \App\Helpers\FunctionsHelpers::$arrTip
     */
    public function create()
    {
        $tip = FunctionsHelpers::$arrTip;
        $rating = FunctionsHelpers::$arrRatings;
        $category = self::$categoryRepository->getCategory()->get();
        $country = self::$countryRepository->getCountry(['id', 'title']);

        return view('admin.anime.add', compact('category', 'tip', 'rating', 'country'));
    }

    /**
     * Сохранение новой записи
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
     */
    public function update(Request $request, $animeUrl): RedirectResponse
    {
        $updateAnime = self::$animeRepository->setAnime($request, $animeUrl);

        if ($updateAnime) {
            return redirect()->route('admin.anime.edit', $animeUrl);
        }
        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }

    /**
     * Удаление записи
     *
     * @param $animeUrl
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($animeUrl)
    {
        $updateAnime = self::$animeRepository->delAnime($animeUrl);
        if ($updateAnime) {
            return redirect()->route('admin.anime');
        }
        return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
    }
}
