<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


interface CustomRepositoryInterface
{
    public function getCustom($select = '*', $columns = '', $custom = '');
}
