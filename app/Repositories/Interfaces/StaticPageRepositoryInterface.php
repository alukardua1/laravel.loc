<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface StaticPageRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface StaticPageRepositoryInterface
{
    /**
     * @param mixed $url Url static page
     *
     * @return mixed
     */
    public function getStaticPage($url);
}
