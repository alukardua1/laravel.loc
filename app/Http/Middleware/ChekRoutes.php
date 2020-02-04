<?php

namespace App\Http\Middleware;

use Closure;


class ChekRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        dd(__METHOD__, $request);
        if (!$request->expectsJson()) {
            return route('home');
        }
        /*
        return $next($request);*/
    }
}
