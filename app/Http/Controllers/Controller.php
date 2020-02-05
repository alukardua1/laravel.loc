<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelpers;
use App\Repositories\MainCustomRepository;
use App\Repositories\MainRepository;
use App\Repositories\MainSetRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    protected static $mainRepository;
    protected static $mainSetRepository;
    protected static $mainCustomRepository;
    protected static $theme;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionsHelpers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $test = '';
        self::$mainRepository = app(MainRepository::class);
        self::$mainSetRepository = app(MainSetRepository::class);
        self::$mainCustomRepository = app(MainCustomRepository::class);
        self::$theme = env('APP_THEME');
        $kind = FunctionsHelpers::$arrTip;

        View::share([
            'categoryAll'      => self::$mainRepository->getAllCategory(),
            'caruselAnimePost' => self::$mainRepository->getStatus('ongoing', 100),
            'tip'             => FunctionsHelpers::$arrTip,
            'theme'            => self::$theme,
        ]);
    }
}
