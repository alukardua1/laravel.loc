<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


interface VoteRepositoryInterface
{
    public function plusVotes($id);

    public function minusVotes($id);
}