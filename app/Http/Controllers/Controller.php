<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelpers;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\CustomRepositoryInterface;
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
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $customRepository;

    /**
     * @var \App\Repositories\CategoryRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $categoryRepository;

    /**
     * @var \App\Repositories\CountryRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $countryRepository;

    use AuthorizesRequests;
    use DispatchesJobs;
    use FunctionsHelpers;
    use ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        self::$customRepository = app(CustomRepositoryInterface::class);
        self::$categoryRepository = app(CategoryRepositoryInterface::class);
        self::$countryRepository = app(CountryRepositoryInterface::class);

        self::$globalCategory = self::$categoryRepository->getCategory()->get();
        self::$paginate = config('appSecondConfig.paginate');
        self::$theme = config('appSecondConfig.theme');
        self::$kind = FunctionsHelpers::$arrRating;
        $nameSite = config('appSecondConfig.nameSite');

        $year = self::$customRepository->getCustom('aired_season')->get();
        $tip = self::$customRepository->getCustom('tip')->get();
        $carouselAnime = self::$customRepository->getCustom('*', 'released', 'ongoing')->get();

        View::share([
            'categoryAll'   => self::$globalCategory,
            'carouselAnime' => $carouselAnime,
            'yearCustom'    => $this->customArr($year, 'aired_season'),
            'tipRu'         => FunctionsHelpers::$arrTip,
            'tip'           => $this->customArr($tip, 'tip'),
            'theme'         => self::$theme,
            'kind'          => self::$kind,
            'nameSite'      => $nameSite,
        ]);
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
