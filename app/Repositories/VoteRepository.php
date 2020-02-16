<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Repositories\Interfaces\VoteRepositoryInterface;
use Auth;

/**
 * Class VoteRepository
 * @package App\Repositories
 */
class VoteRepository implements VoteRepositoryInterface
{
    /**
     * @param $id
     */
    public function plusVotes($id)
    {
        Auth::user()->vote()->attach($id, ['votes' => 1]);
    }

    /**
     * @param $id
     */
    public function minusVotes($id)
    {
        Auth::user()->vote()->attach($id, ['votes' => -1]);
    }
}
