<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Helpers;


use Cache;

/**
 * Trait CreateCacheTrait
 * @package App\Helpers
 */
trait CreateCacheTrait
{
    /**
     * @param $key
     * @param $post
     * @return mixed
     */
    public static function setCache($key, $post)
    {
        $ttl = (int)config('appSecondConfig.ttlCache');

        return Cache::remember($key, $ttl * 86400, function () use ($post)
        {
            return $post;
        });
    }
}