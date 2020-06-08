<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Repositories\Interfaces\CharacterRepositoryInterface;

/**
 * Class CharacterRepository
 *
 * @package App\Repositories
 */
class CharacterRepository implements CharacterRepositoryInterface
{

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getCharacter($id)
    {
        return "Hello Character!!";
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function setCharacter($id)
    {
        return "Hello Character!!";
    }
}
