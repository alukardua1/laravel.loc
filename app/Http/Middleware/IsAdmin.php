<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  array  $group
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$group)
    {
        foreach ($group as $value) {
            if (Auth::user()->group_id == $value) {
                return $next($request);
            }
        }

        return redirect('404');
    }
}
