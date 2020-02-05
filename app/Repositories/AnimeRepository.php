<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\AnimeRepositoryInterface;

class AnimeRepository implements AnimeRepositoryInterface
{

    /**
     * @param  null  $url
     * @param  int   $posted
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAnime($url = null)
    {
        if ($url) {
            $result = Anime::with(['getCategory'])
                ->where('url', $url)
                ->orderBy('created_at', 'DESC');
        } else {
            $result = Anime::with(['getCategory'])
                ->where('posted_at', 1)
                ->orderBy('created_at', 'DESC');
        }

        return $result;
    }
}
