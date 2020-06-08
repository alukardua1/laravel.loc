<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface PeopleRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface PeopleRepositoryInterface
{
    /**
     * @param $id
     *
     * @return mixed
     */public function getPeople($id);

    /**
     * @param $id
     *
     * @return mixed
     */public function setPeople($id);
}
