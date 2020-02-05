<?php


namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\CustomRepositoryInterface;

class CustomRepository implements CustomRepositoryInterface
{

    public function getCustom($columns, $custom, $paginate)
    {
        $result = Anime::with(['getCategory'])
            ->where($columns, $custom)
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);

        return $result;
    }
}
