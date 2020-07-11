<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Traits\ShowApiPost;
use Illuminate\Routing\Controller as BaseController;

class BaseApiController extends BaseController
{
	use ShowApiPost;

	public static $paginate;

	public function __construct()
	{
		self::$paginate = config('appSecondConfig.paginate');
	}
}
