<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface AnimeRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface AnimeRepositoryInterface
{
    /**
     * @param  null  $url Url default null
     *
     * @return mixed
     */
    public function getAnime($url = null);
}
