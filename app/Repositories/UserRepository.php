<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Auth;
use Hash;
use Storage;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{

    public function getUsers($user)
    {
        $result = User::with(['getGroup:id,title', 'getCountry:id,title'])
            ->where('login', $user)
            ->first();

        return $result;
    }

    /**
     * @param  \App\Http\Requests\UserRequest  $request
     * @param                                  $user
     *
     * @return mixed
     */
    public function setUser($request, $user)
    {
        if ($request->user()) {
            $updateUser = User::where('login', $user)->first();
            $data = $request->all();
            if ($data['old_password']) {
                if (Hash::check($data['old_password'], Auth::user()->getAuthPassword())) {
                    $data['password'] = Hash::make($data['new_password']);
                } else {
                    return back()->withErrors(['msg' => 'Введите правильный пароль'])->withInput();
                }
            }

            $data = self::uploadAvatar($updateUser, $data, $request);
            $result = $updateUser->update($data);

            return $result;
        }
    }

    /**
     * @param $updateUser
     * @param $data
     * @param $request
     *
     * @return mixed
     */
    public function uploadAvatar($updateUser, $data, $request)
    {
        if (isset($data['del_foto'])) {
            $data['photo'] = '';
            Storage::delete('public/avatars'.$updateUser->photo);
            $data['photo'] = '';
        } else {
            if ($request->hasFile('photo')) {
                //dd(__METHOD__, $data['photo'], $_FILES);
                $Extension = $data['photo']->getClientOriginalExtension();
                $fileName = 'foto_'.$updateUser['id'].'.'.$Extension;
                $path = Storage::putFileAs(
                    'public/avatars', $data['photo'], $fileName
                );
                $data['photo'] = $fileName;
            }
        }
        return $data;
    }
}
