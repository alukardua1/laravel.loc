<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface CharacterRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CharacterRepositoryInterface
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getCharacter($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function setCharacter($id);
}
