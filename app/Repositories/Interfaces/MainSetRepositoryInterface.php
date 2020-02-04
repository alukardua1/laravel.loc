<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface MainSetRepositoryInterface
{
    public static function setUser(Request $request, $user);

    public static function uploadAvatar($updateUser, $data, $request);
}
