<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Http\Middleware\IsAdmin;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class AdminBaseController
 *
 * @package App\Http\Controllers\Administrations
 */
class AdminBaseController extends BaseController
{
	/**
	 * @var int $paginate
	 */
	protected static $paginate;


	/**
	 * AdminBaseController constructor.
	 *
	 * @uses int self::$paginate
	 */
	public function __construct()
	{
		$this->middleware(['role:1', 'auth']);
		self::$paginate = config('appSecondConfig.paginateAdmin');
	}
}
