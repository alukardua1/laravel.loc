<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Traits\ShowApiPost;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class BaseApiController
 *
 * @package App\Http\Controllers\Api
 */
class BaseApiController extends BaseController
{
    use ShowApiPost;

    /**
     * @var Repository|Application|mixed
     */
    public static $paginate;

    /**
     * BaseApiController constructor.
     */
    public function __construct()
    {
        self::$paginate = config('appSecondConfig.paginate');
    }
}
