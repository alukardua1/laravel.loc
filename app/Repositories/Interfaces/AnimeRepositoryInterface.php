<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface AnimeRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface AnimeRepositoryInterface
{
    /**
     * @param  null  $url  Url default null
     *
     * @param  bool  $isAdmin
     *
     * @return mixed
     */
    public function getAnime($url = null, $isAdmin = false);

    /**
     * @param  Request  $request
     * @param  null  $url
     *
     * @return mixed
     */
    public function setAnime(Request $request, $url = null);

    /**
     * @param $url
     *
     * @return mixed
     */
    public function delAnime($url);

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getSearch(Request $request);
}
