<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * @param string $userUrl Url users
     *
     * @return mixed
     */
    public function getUsers($userUrl);

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param                            $currentUser
     *
     * @return mixed
     */
    public function setUsers(Request $request, $currentUser);
}
