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
     * @param  null  $id  Url default null
     *
     * @param  bool  $isAdmin
     *
     * @return mixed
     */
    public function getAnime($id = null, $isAdmin = false);

    /**
     * @param  Request  $request
     * @param  null     $id
     *
     * @return mixed
     */
    public function setAnime(Request $request, $id = null);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delAnime($id);

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getSearch(Request $request);

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function sortAnime(Request $request);
}
