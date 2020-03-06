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
     * @param $userUrl
     *
     * @return mixed
     */
    public function getUsers($userUrl);

    /**
     * @param  Request  $request
     * @param                            $currentUser
     *
     * @return mixed
     */
    public function setUsers(Request $request, $currentUser);
}
