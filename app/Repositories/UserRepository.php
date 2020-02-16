<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\UsersTrait;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{

    use UsersTrait;

    /**
     * @param $userUrl
     *
     * @return Builder|Model|mixed|object|null
     */
    public function getUsers($userUrl)
    {
        return User::with(['getGroup:id,title', 'getCountry:id,title'])
            ->where('login', $userUrl)
            ->first();
    }

    /**
     * @param  Request  $request
     * @param                            $currentUser
     *
     * @return mixed
     */
    public function setUsers($request, $currentUser)
    {
        $userSave = [];
        if ($request->user()) {
            $updateUser = User::where('login', $currentUser)->first();
            $requestForm = $request->all();

            if ($requestForm['old_password']) {
                $this->updatePasswords($updateUser, $requestForm);
            }

            if (isset($requestForm['del_foto'])) {
                $userSave = $this->deleteAvatar($updateUser, $requestForm);
            }

            if ($request->hasFile('photo')) {
                $userSave = $this->uploadAvatar($updateUser, $requestForm);
            }

            return $updateUser->update($userSave);
        }
    }
}
