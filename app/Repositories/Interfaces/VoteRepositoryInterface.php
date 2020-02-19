<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface VoteRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface VoteRepositoryInterface
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function plusVotes($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function minusVotes($id);
}
