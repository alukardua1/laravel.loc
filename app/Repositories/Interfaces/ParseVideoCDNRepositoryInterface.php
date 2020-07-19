<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface ParseVideoCDNRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface ParseVideoCDNRepositoryInterface
{
    /**
     * @param $arr
     *
     * @return mixed
     */
    public function parseCurl($arr);

    /**
     * @return mixed
     */
    public function parseData();
}
