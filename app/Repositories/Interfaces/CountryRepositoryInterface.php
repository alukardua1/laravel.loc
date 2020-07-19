<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface CountryRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CountryRepositoryInterface
{
    /**
     * @param array $selectColumns Load select columns
     *
     * @return mixed
     */
    public function getCountry($selectColumns);
}
