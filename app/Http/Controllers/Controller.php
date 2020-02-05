<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelpers;
use App\Repositories\AnimeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CustomRepository;
use App\Repositories\MainCustomRepository;
use App\Repositories\MainRepository;
use App\Repositories\MainSetRepository;
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


        View::share([
            'categoryAll'      => self::$globalCategory,
            'caruselAnimePost' => [],
            'tip'              => FunctionsHelpers::$arrTip,
            'theme'            => self::$theme,
            'kind'             => self::$kind
        ]);
    }
}
