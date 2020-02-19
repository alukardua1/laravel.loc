<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


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
}
