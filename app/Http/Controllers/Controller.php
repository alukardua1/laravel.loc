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
    protected static $kind;
    /**
     * @var int $paginate
     */
    protected static $paginate;

    /**
     * @var array $globalCategory
     */
    protected static $globalCategory;

    /**
     * @var \App\Repositories\AnimeRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $animeRepository;
    /**
     * @var \App\Repositories\CategoryRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $categoryRepository;
    /**
     * @var \App\Repositories\UserRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $userRepository;
    /**
     * @var \App\Repositories\CountryRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $countryRepository;
    /**
     * @var \App\Repositories\CustomRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $customRepository;
    /**
     * @var \App\Repositories\StaticPageRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static $staticPageRepository;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionsHelpers;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        self::$categoryRepository = app(CategoryRepositoryInterface::class);
        self::$countryRepository = app(CountryRepositoryInterface::class);
        self::$customRepository = app(CustomRepositoryInterface::class);

        self::$globalCategory = self::$categoryRepository->getCategory()->get();
        self::$paginate = env('APP_PAGINATE');
        self::$theme = env('APP_THEME');
        self::$kind = FunctionsHelpers::$arrRating;
        $year = self::$customRepository->getCustom('aired_season')->get();
        $tip = self::$customRepository->getCustom('tip')->get();

        View::share([
            'categoryAll'   => self::$globalCategory,
            'carouselAnime' => self::$customRepository->getCustom('*', 'released', 'ongoing')->get(),
            'yearCustom'    => $this->customArr($year, 'aired_season'),
            'tipRu'         => FunctionsHelpers::$arrTip,
            'tip'           => $this->customArr($tip, 'tip'),
            'theme'         => self::$theme,
            'kind'          => self::$kind
        ]);
    }

    /**
     * Обрабатывает поля для глобальных кустом
     *
     * @param array $arr
     * @param string $keys
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
