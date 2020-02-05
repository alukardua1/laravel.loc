<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getUsers($user);

    public function setUser(Request $request, $user);

    public function uploadAvatar($updateUser, $data, $request);
}
