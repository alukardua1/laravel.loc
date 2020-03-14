<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\CustomRepositoryInterface;
use App\Traits\CreateCacheTrait;
use App\Traits\FunctionsTrait;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Lang;
use View;


/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
	/**
	 * Текущая тема шаблона
	 *
	 * @var string $theme
	 */
	protected static $theme;

	/**
	 * Ограничение по возрасту
	 *
	 * @var array $kind
	 */
	private static $kind;

	/**
	 * Пагинация
	 *
	 * @var int $paginate
	 */
	protected static $paginate;

	/**
	 * Вывод категорий на сайте
	 *
	 * @var array $globalCategory
	 */
	private static $globalCategory;

	/**
	 * Вывод карусели
	 *
	 * @var mixed $carouselAnime
	 */
	protected static $carouselAnime;

	/**
	 * Название сайта
	 *
	 * @var string $nameSite
	 */
	protected static $nameSite;

	/**
	 * Вывод года
	 *
	 * @var array $yearCustom
	 */
	protected static $yearCustom;

	/**
	 * Вывод тип
	 *
	 * @var array $tipCustom
	 */
	protected static $tipCustom;

	/**
	 * Кустом репозиторий
	 *
	 * @var Application|mixed
	 */
	protected static $customRepository;

	/**
	 * Репозиторий категорий
	 *
	 * @var CategoryRepository|Application|mixed
	 */
	protected static $categoryRepository;

	/**
	 * Репозиторий стран
	 *
	 * @var CountryRepository|Application|mixed
	 */
	protected static $countryRepository;

	use AuthorizesRequests;
	use DispatchesJobs;
	use FunctionsTrait;
	use ValidatesRequests;
	use CreateCacheTrait;

	/**
	 * Controller constructor.
	 */
	public function __construct()
	{
		self::$customRepository = app(CustomRepositoryInterface::class);
		self::$categoryRepository = app(CategoryRepositoryInterface::class);
		self::$countryRepository = app(CountryRepositoryInterface::class);

		if (Cache::has('globalCategory')) {
			self::$globalCategory = Cache::get('globalCategory');
		}else{
			self::$globalCategory = self::setCache('globalCategory', self::$categoryRepository->getCategory()->get());
		}
		if (Cache::has('aired_season')) {
			self::$yearCustom = Cache::get('aired_season');
		}else{
			self::$yearCustom = self::setCache('aired_season', self::$customRepository->getCustom('aired_season')->get());
		}
		if (Cache::has('tip')) {
			self::$tipCustom = Cache::get('tip');
		}else{
			self::$tipCustom = self::setCache('tip', self::$customRepository->getCustom('tip')->get());
		}
		if (Cache::has('ongoing')) {
			self::$carouselAnime = Cache::get('ongoing');
		}else{
			self::$carouselAnime = self::setCache('ongoing', self::$customRepository->getCustom('*', 'released', 'ongoing')->get());
		}

		self::$paginate = config('appSecondConfig.paginate');
		self::$theme = config('appSecondConfig.theme');
		self::$kind = Lang::get('attributes.rating');
		self::$nameSite = config('appSecondConfig.nameSite');
		self::$yearCustom = self::customArr(self::$yearCustom, 'aired_season');
		self::$tipCustom = self::customArr(self::$tipCustom, 'tip');

		View::share(
			[
				'categoryAll'   => self::$globalCategory,
				'carouselAnime' => self::$carouselAnime,
				'yearCustom'    => self::$yearCustom,
				'tipRu'         => Lang::get('attributes.minTip'),
				'tipFullRu'     => Lang::get('attributes.fullTip'),
				'tip'           => self::$tipCustom,
				'theme'         => self::$theme,
				'kind'          => self::$kind,
				'nameSite'      => self::$nameSite,
			]
		);
	}
}
