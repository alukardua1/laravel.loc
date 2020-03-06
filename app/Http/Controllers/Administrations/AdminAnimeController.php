<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\TranslateRepositoryInterface;
use App\Traits\FunctionsTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Lang;

/**
 * Class AdminAnimeController
 *
 * @package App\Http\Controllers\Administrations
 */
class AdminAnimeController extends AdminBaseController
{
	use FunctionsTrait;

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
	 * @var $animePost
	 * @uses AdminBaseController::$paginate
	 * @return Factory|View
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
	 * @var array $tip
	 * @var array $rating
	 * @var mixed $category
	 * @var mixed $animePost
	 * @uses CategoryRepository
	 * @uses AnimeRepository
	 *
	 * @return Factory|View
	 */
	public function edit($animeUrl)
	{
		$tip = Lang::get('attributes.minTip');
		$rating = Lang::get('attributes.rating');
		$category = self::$categoryRepository->getCategory()->get();
		$animePost = self::$animeRepository->getAnime($animeUrl)->first();
		$country = self::$countryRepository->getCountry(['id', 'title']);
		$translate = self::$translateRepository->getTranslate();

		return view('admin.anime.edit', compact('animePost', 'category', 'tip', 'rating', 'country', 'translate'));
	}

	/**
	 * Добавление нового поста
	 *
	 * @var array $rating
	 * @var mixed $category
	 * @var mixed $animePost
	 * @var array $tip
	 * @uses CategoryRepository
	 * @uses AnimeRepository
	 * @uses FunctionsTrait::$arrTip
	 *
	 * @return Factory|View
	 */
	public function create()
	{
		$tip = Lang::get('attributes.minTip');
		$rating = Lang::get('attributes.rating');
		$category = self::$categoryRepository->getCategory()->get();
		$country = self::$countryRepository->getCountry(['id', 'title']);

		return view('admin.anime.add', compact('category', 'tip', 'rating', 'country'));
	}

	/**
	 * Сохранение новой записи
	 *
	 * @param  Request  $request
	 *
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
	 * @param           $animeUrl
	 *
	 * @return RedirectResponse
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
	 * @return RedirectResponse
	 */
	public function delete($animeUrl): RedirectResponse
	{
		$updateAnime = self::$animeRepository->delAnime($animeUrl);
		if ($updateAnime) {
			return redirect()->route('admin.anime');
		}
		return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
	}
}
