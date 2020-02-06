<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\CustomRepositoryInterface;

/**
 * Class CustomRepository
 *
 * @package App\Repositories
 */
class CustomRepository implements CustomRepositoryInterface
{
    /**
     * @param  string  $select
     * @param  null    $columns
     * @param  null    $variable
     *
     * @return mixed
     */
    public function getCustom($select = '*', $columns = null, $variable = null)
    {
        if ($columns) {
            return Anime::select($select)
                ->with(['getCategory'])
                ->where($columns, $variable)
                ->where('posted_at', 1)
                ->orderBy('created_at', 'DESC');
        }
        return Anime::select($select)
            ->where('posted_at', 1)
            ->orderBy('created_at', 'DESC');
    }
}
