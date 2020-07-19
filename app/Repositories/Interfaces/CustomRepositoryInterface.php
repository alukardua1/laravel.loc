<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface CustomRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CustomRepositoryInterface
{
    /**
     * @param mixed  $select   DB select columns
     * @param string $columns  Selected columns db
     * @param string $variable Search value
     *
     * @return mixed
     */
    public function getCustom($select = '*', $columns = null, $variable = null);
}
