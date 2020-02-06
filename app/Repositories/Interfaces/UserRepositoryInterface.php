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
     * @param $user
     *
     * @return mixed
     */
    public function getUsers($user);

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param                            $user
     *
     * @return mixed
     */
    public function setUser(Request $request, $user);

    /**
     * @param $updateUser
     * @param $userData
     * @param $request
     *
     * @return mixed
     */
    public function uploadAvatar($updateUser, $userData, $request);
}
