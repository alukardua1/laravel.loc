<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


use Hash;
use Storage;

/**
 * Trait UsersTrait
 *
 * @package App\Traits
 */
trait UsersTrait
{
    /**
     * @param  array  $updateUser  Current users
     * @param  array  $requestForm  Request
     *
     * @return mixed Updated request
     */
    public function uploadAvatar($updateUser, $requestForm)
    {
        if (file_exists('public/avatars/'.$updateUser->photo)) {
            $requestForm = $this->deleteAvatar($updateUser, $requestForm);
        }

        $Extension = $requestForm['photo']->getClientOriginalExtension();
        $fileName = 'photo_'.$updateUser->id.'.'.$Extension;

        Storage::putFileAs(
            'public/avatars/'.$updateUser->login.'/',
            $requestForm['photo'],
            $fileName
        );

        $requestForm['photo'] = $updateUser->login.'/'.$fileName;

        return $requestForm;
    }

    /**
     * @param  array  $updateUser  Current users
     * @param  array  $requestForm  Request
     *
     * @return mixed|void Updated request
     */
    public function deleteAvatar($updateUser, $requestForm)
    {
        Storage::delete('public/avatars/'.$updateUser->photo);
        $requestForm['photo'] = '';

        return $requestForm;
    }

    /**
     * @param  array  $updateUser  Current users
     * @param  array  $requestForm  Request
     *
     * @return string
     */
    public function updatePasswords($updateUser, $requestForm): string
    {
        if (Hash::check($requestForm['old_password'], $updateUser['password'])) {
            return $requestForm['password'] = Hash::make($requestForm['new_password']);
        }
        return back()->withErrors(['msg' => 'Введите правильный пароль'])->withInput();
    }
}
