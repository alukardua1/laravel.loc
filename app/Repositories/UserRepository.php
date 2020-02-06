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

    /**
     * @param $user
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getUsers($user)
    {
        return User::with(['getGroup:id,title', 'getCountry:id,title'])
            ->where('login', $user)
            ->first();
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
            $requestForm = $request->all();
            if ($requestForm['old_password']) {
                if (Hash::check($requestForm['old_password'], $updateUser['password'])) {
                    $requestForm['password'] = Hash::make($requestForm['new_password']);
                } else {
                    return back()->withErrors(['msg' => 'Введите правильный пароль'])->withInput();
                }
            }

            $userSave = $this->uploadAvatar($updateUser, $requestForm, $request);
            return $updateUser->update($userSave);
        }
    }

    /**
     * @param $updateUser
     * @param $userData
     * @param $request
     *
     * @return mixed
     */
    public function uploadAvatar($updateUser, $userData, $request)
    {
        if (isset($userData['del_foto'])) {
            $userData['photo'] = '';
            Storage::delete('public/avatars'.$updateUser->photo);
            $userData['photo'] = '';
        } else {
            if ($request->hasFile('photo')) {
                $Extension = $userData['photo']->getClientOriginalExtension();
                $fileName = 'foto_'.$updateUser['id'].'.'.$Extension;
                Storage::putFileAs(
                    'public/avatars', $userData['photo'], $fileName
                );
                $userData['photo'] = $fileName;
            }
        }
        return $userData;
    }
}
