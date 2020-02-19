<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers;

use App\Helpers\CreateCacheTrait;
use App\Helpers\FunctionsHelpers;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\CustomRepositoryInterface;
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
     * @var mixed
     */
    protected static $theme;
    /**
     * @var array $kind
     */
    private static $kind;
    /**
     * @var int $paginate
     */
    protected static $paginate;

    /**
     * @var array $globalCategory
     */
    private static $globalCategory;

    /**
     * @var Application|mixed
     */
    protected static $customRepository;

    /**
     * @var CategoryRepository|Application|mixed
     */
    protected static $categoryRepository;

    /**
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
            $tip = Cache::get('tip');
        } else {
            $tip = self::setCache('tip', self::$customRepository->getCustom('tip')->get());
        }
        if (Cache::has('ongoing')) {
            $carouselAnime = Cache::get('ongoing');
        } else {
            $carouselAnime = self::setCache(
                'ongoing',
                self::$customRepository->getCustom('*', 'released', 'ongoing')->get()
            );
        }

        self::$paginate = config('appSecondConfig.paginate');
        self::$theme = config('appSecondConfig.theme');
        self::$kind = FunctionsHelpers::$arrRating;
        $nameSite = config('appSecondConfig.nameSite');

        View::share(
            [
                'categoryAll'   => self::$globalCategory,
                'carouselAnime' => $carouselAnime,
                'yearCustom'    => $this->customArr($year, 'aired_season'),
                'tipRu'         => FunctionsHelpers::$arrTip,
                'tipFullRu'     => FunctionsHelpers::$arrFullTip,
                'tip'           => $this->customArr($tip, 'tip'),
                'theme'         => self::$theme,
                'kind'          => self::$kind,
                'nameSite'      => $nameSite,
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
    private function customArr($arr, $keys): array
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
