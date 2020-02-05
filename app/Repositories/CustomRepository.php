<?php


namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\CustomRepositoryInterface;

class CustomRepository implements CustomRepositoryInterface
{

    public function getCustom($select = '*', $columns = null, $custom = null)
    {
        if ($columns) {
            $result = Anime::select($select)
                ->with(['getCategory'])
                ->where($columns, $custom)
                ->orderBy('created_at', 'DESC');
        } else {
            $result = Anime::select($select)
                /*->with(['getCategory'])*/
                ->orderBy('created_at', 'DESC');
        }

        return $result;
    }
}
