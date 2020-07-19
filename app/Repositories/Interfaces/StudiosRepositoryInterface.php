<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface StudiosRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface StudiosRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getStudio();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function setStudio($id);
}
