<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getUsers($user);

    public function setUser(Request $request, $user);

    public function uploadAvatar($updateUser, $data, $request);
}
