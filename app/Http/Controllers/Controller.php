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
use App\Traits\FunctionsHelpers;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
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
     * @var \Illuminate\Contracts\Foundation\Application|mixed
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
    use FunctionsHelpers;
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

        self::$globalCategory = self::getCache('globalCategory', self::$categoryRepository->getCategory()->get());
        self::$yearCustom = self::getCache('aired_season', self::$customRepository->getCustom('aired_season')->get());
        self::$tipCustom = self::getCache('tip', self::$customRepository->getCustom('tip')->get());
        self::$carouselAnime = self::getCache(
            'ongoing',
            self::$customRepository->getCustom('*', 'released', 'ongoing')->get()
        );

        self::$paginate = config('appSecondConfig.paginate');
        self::$theme = config('appSecondConfig.theme');
        self::$kind = FunctionsHelpers::$arrRating;
        self::$nameSite = config('appSecondConfig.nameSite');
        self::$yearCustom = self::customArr(self::$yearCustom, 'aired_season');
        self::$tipCustom = self::customArr(self::$tipCustom, 'tip');

        View::share(
            [
                'categoryAll' => self::$globalCategory,
                'carouselAnime' => self::$carouselAnime,
                'yearCustom' => self::$yearCustom,
                'tipRu' => FunctionsHelpers::$arrTip,
                'tipFullRu' => FunctionsHelpers::$arrFullTip,
                'tip' => self::$tipCustom,
                'theme' => self::$theme,
                'kind' => self::$kind,
                'nameSite' => self::$nameSite,
            ]
        );
    }
}
