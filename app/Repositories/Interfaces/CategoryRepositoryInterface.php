<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


use Request;

/**
 * Interface CategoryRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CategoryRepositoryInterface
{
    /**
     * @param  null  $url  Url default null
     *
     * @param  bool  $isAdmin
     *
     * @return mixed
     */
    public function getCategory($url = null, $isAdmin = false);

    /**
     * @param  \Request  $request
     * @param  null      $url
     *
     * @return mixed
     */
    public function setCategory(Request $request, $url = null);

    /**
     * @param $url
     *
     * @return mixed
     */
    public function delCategory($url);
}
