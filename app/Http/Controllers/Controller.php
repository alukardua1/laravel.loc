<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelpers;
use App\Repositories\AnimeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CustomRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    protected static $theme;
    protected static $kind;
    protected static $paginate;

    protected static $globalCategory;

    protected static $animeRepository;
    protected static $categoryRepository;
    protected static $userRepository;
    protected static $countryRepository;
    protected static $customRepository;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionsHelpers;

    /**
     * Create a new controller instance.
     *
     * @param  null  $value
     */
    public function __construct()
    {
        self::$animeRepository = app(AnimeRepository::class);
        self::$categoryRepository = app(CategoryRepository::class);
        self::$userRepository = app(UserRepository::class);
        self::$countryRepository = app(CountryRepository::class);
        self::$customRepository = app(CustomRepository::class);

        self::$globalCategory = self::$categoryRepository->getCategory()->get();

        self::$paginate = env('APP_PAGINATE');
        self::$theme = env('APP_THEME');
        self::$kind = FunctionsHelpers::$arrRating;
        $year = self::$customRepository->getCustom('aired_season')->get();
        $tip = self::$customRepository->getCustom('tip')->get();

        //dd(__METHOD__, $this->customArr($year, 'aired_season'));
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

    private function customArr($arr, $keys)
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
