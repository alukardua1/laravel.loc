<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\AnimeRepositoryInterface;

/**
 * Class AnimeRepository
 *
 * @package App\Repositories
 */
class AnimeRepository implements AnimeRepositoryInterface
{

    /**
     * @param  mixed  $url
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAnime($url = null): \Illuminate\Database\Eloquent\Builder
    {
        if ($url) {
            return Anime::with(['getCategory'])
                ->where('url', $url)
                ->orderBy('created_at', 'DESC');
        }
        return Anime::with(['getCategory'])
            ->where('posted_at', 1)
            ->orderBy('created_at', 'DESC');
    }
}
