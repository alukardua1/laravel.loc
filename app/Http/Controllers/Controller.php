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
     * @var mixed
     */
    protected static $theme;

    /**
     * Ограничение по возрасту
     * @var array $kind
     */
    private static $kind;

    /**
     * Пагинация
     * @var int $paginate
     */
    protected static $paginate;

    /**
     * Вывод категорий на сайте
     * @var array $globalCategory
     */
    private static $globalCategory;

    /**
     * Вывод карусели
     * @var mixed
     */
    protected static $carouselAnime;

    /**
     * Название сайта
     * @var \Illuminate\Config\Repository|mixed
     */
    protected static $nameSite;

    /**
     * Вывод года
     * @var array
     */
    protected static $yearCustom;

    /**
     * Вывод тип
     * @var array
     */
    protected static $tip;

    /**
     * Кустом репозиторий
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $customRepository;

    /**
     * Репозиторий категорий
     * @var CategoryRepository|Application|mixed
     */
    protected static $categoryRepository;

    /**
     * Репозиторий стран
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

        if (Cache::has('globalCategory')) {
            self::$globalCategory = Cache::get('globalCategory');
        } else {
            self::$globalCategory = self::setCache('globalCategory', self::$categoryRepository->getCategory()->get());
        }
        if (Cache::has('aired_season')) {
            $year = Cache::get('aired_season');
        } else {
            $year = self::setCache('aired_season', self::$customRepository->getCustom('aired_season')->get());
        }
        if (Cache::has('tip')) {
            self::$tip = Cache::get('tip');
        } else {
            self::$tip = self::setCache('tip', self::$customRepository->getCustom('tip')->get());
        }
        if (Cache::has('ongoing')) {
            self::$carouselAnime = Cache::get('ongoing');
        } else {
            self::$carouselAnime = self::setCache(
                'ongoing',
                self::$customRepository->getCustom('*', 'released', 'ongoing')->get()
            );
        }

        self::$paginate = config('appSecondConfig.paginate');
        self::$theme = config('appSecondConfig.theme');
        self::$kind = FunctionsHelpers::$arrRating;
        self::$nameSite = config('appSecondConfig.nameSite');
        self::$yearCustom = self::customArr($year, 'aired_season');
        self::$tip = self::customArr(self::$tip, 'tip');

        View::share(
            [
                'categoryAll'   => self::$globalCategory,
                'carouselAnime' => self::$carouselAnime,
                'yearCustom'    => self::$yearCustom,
                'tipRu'         => FunctionsHelpers::$arrTip,
                'tipFullRu'     => FunctionsHelpers::$arrFullTip,
                'tip'           => self::$tip,
                'theme'         => self::$theme,
                'kind'          => self::$kind,
                'nameSite'      => self::$nameSite,
            ]
        );
    }

    /**
     * Обрабатывает поля для глобальных кустом
     *
     * @param  array   $arr
     * @param  string  $keys
     *
     * @return array
     */
    private static function customArr($arr, $keys): array
    {
        $result = [];
        foreach ($arr as $key => $value) {
            $result[] = $value[$keys];
        }
        $result = array_count_values($result);

        krsort($result);

        return $result;
    }
}
