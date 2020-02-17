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
     * AdminAnimeController constructor.
     *
     * @param  AnimeRepositoryInterface  $animeRepository
     * @param  CategoryRepositoryInterface  $categoryRepository
     * @param  CountryRepositoryInterface  $countryRepository
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
     * @return Factory|View
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
     * @return Factory|View
     *
     * @uses \App\Helpers\FunctionsHelpers::$arrTip
     * @uses \App\Helpers\FunctionsHelpers::$arrRatings
     * @uses \App\Repositories\CategoryRepository
     * @uses \App\Repositories\AnimeRepository
     *
     * @var array $tip
     * @var array $rating
     * @var mixed $category
     * @var mixed $animePost
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

    /**
     * Добавление нового поста
     *
     * @return Factory|View
     *
     * @uses \App\Helpers\FunctionsHelpers::$arrTip
     * @uses \App\Helpers\FunctionsHelpers::$arrRatings
     * @uses \App\Repositories\CategoryRepository
     * @uses \App\Repositories\AnimeRepository
     *
     * @var array $tip
     * @var array $rating
     * @var mixed $category
     * @var mixed $animePost
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
     * @param  Request  $request
     * @return RedirectResponse
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
     * @param  Request  $request
     * @param  string  $animeUrl
     *
     * @return RedirectResponse
     * @var  mixed $updateAnime
     *
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
     * @param $animeUrl
     * @return RedirectResponse
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
