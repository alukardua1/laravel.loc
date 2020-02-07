<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CustomRepositoryInterface;
use Cache;

/**
 * Trait Cache
 *
 * @package App\Traits
 */
trait CacheTrait
{
    /**
     * @param  string  $nameCache
     * @param  string  $columns
     * @param  string  $variable
     * @param  array   $selectColumns
     * @param  int     $timeCache
     *
     * @return mixed
     */
    public function addLoadCacheCustomColumns(
        $nameCache,
        $columns,
        $variable = '',
        $selectColumns = ['*'],
        $timeCache = 180
    ) {
        $customRepository = app(CustomRepositoryInterface::class);

        if (Cache::has($nameCache)) {
            return Cache::get($nameCache);
        }

        return Cache::remember($nameCache, $timeCache, function () use ($columns, $customRepository, $variable, $selectColumns) {
            return $customRepository->getCustom($selectColumns, $columns, $variable)->get();
        });
    }

    public function addLoadCacheCategory($nameCache, $timeCache = 180)
    {
        $categoryRepository = app(CategoryRepositoryInterface::class);

        if (Cache::has($nameCache)) {
            return Cache::get($nameCache);
        }

        return Cache::remember($nameCache, $timeCache, function () use ($categoryRepository) {
            return $categoryRepository->getCategory()->get();
        });
    }
}
