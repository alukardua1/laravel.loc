<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionsHelpers;
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

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionsHelpers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        self::$mainRepository = app(MainRepository::class);
        self::$mainSetRepository = app(MainSetRepository::class);
        $kind = FunctionsHelpers::$arrTip;

        View::share([
            'categoryAll'      => self::$mainRepository->getAllCategory(),
            'caruselAnimePost' => self::$mainRepository->getStatus('ongoing', 100),
            'kind'             => FunctionsHelpers::$arrTip,
        ]);
    }
}
