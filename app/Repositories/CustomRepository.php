<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\CustomRepositoryInterface;

class CustomRepository implements CustomRepositoryInterface
{

    /**
     * @param  string  $select
     * @param  null    $columns
     * @param  null    $custom
     *
     * @return mixed
     */
    public function getCustom($select = '*', $columns = null, $custom = null)
    {
        if ($columns) {
            $result = Anime::select($select)
                ->with(['getCategory'])
                ->where($columns, $custom)
                ->where('posted_at', 1)
                ->orderBy('created_at', 'DESC');
        } else {
            $result = Anime::select($select)
                ->where('posted_at', 1)
                /*->with(['getCategory'])*/
                ->orderBy('created_at', 'DESC');
        }

        return $result;
    }
}
