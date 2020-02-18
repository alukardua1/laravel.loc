<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Helpers;


use Cache;

trait CreateCacheTrait
{
    public static function setCache($key, $post)
    {
        $cache = Cache::remember($key, config('appSecondConfig.ttlCache'), function () use ($post)
        {
            return $post;
        });
           return $cache;
    }
}