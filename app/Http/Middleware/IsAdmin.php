<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin extends Middleware
{
	private static $user;
	/**
	 * Handle an incoming request.
	 *
	 * @param  Request  $request
	 * @param  Closure  $next
	 * @param  array    $group
	 *
	 * @var             $value
	 * @return mixed
	 */
	public function handle($request, Closure $next, ...$group)
	{
		self::$user = Auth::user();

		if (in_array(self::$user->group_id, $group, false))
		{
			return $next($request);
		}

		return abort(404);
	}
}
