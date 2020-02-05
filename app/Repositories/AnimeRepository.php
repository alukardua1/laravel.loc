<?php


namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\AnimeRepositoryInterface;

class AnimeRepository implements AnimeRepositoryInterface
{

    public function getAnime($url = null)
    {
        if ($url) {
            $result = Anime::with(['getCategory'])
                ->where('url', $url)
                ->orderBy('created_at', 'DESC');
        } else {
            $result = Anime::with(['getCategory'])
                ->orderBy('created_at', 'DESC');
        }

        return $result;
    }
}
