<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface CommentsRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CommentsRepositoryInterface
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getComments($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function setComments($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function countComments($id);
}
