<?php


namespace App\Repositories;


use App\Models\AnimePost;
use App\Repositories\Interfaces\MainCustomRepositoryInterface;

class MainCustomRepository implements MainCustomRepositoryInterface
{

    public static function custom($xfield, $search, $paginate)
    {
        $result = AnimePost::with(['getCategory'])
            ->where('xfield', 'like', "%$xfield|$search%")
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);

        return $result;
    }
}
