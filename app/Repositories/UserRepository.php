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
     * @var string[]
     */
    private static $withTable = ['getGroup:id,title', 'getCountry:id,title'];

    /**
     * Получает профиль пользователя
     *
     * @param $userUrl
     *
     * @return Builder|Model|mixed|object|null
     */
    public function getUsers($userUrl)
    {
        $user = User::with(self::$withTable)
            ->where('login', $userUrl)
            ->first();
        /** @var User $user */
        $user = $this->refactoringUser($user);

        return $user;
    }

    /**
     * Сохраняет изменения в базу
     *
     * @param Request   $request
     * @param           $currentUser
     *
     * @return mixed
     */
    public function setUsers($request, $currentUser)
    {
        if ($request->user()) {
            $updateUser = User::where('login', $currentUser)->first();
            $requestForm = $request->all();

            if ($requestForm['old_password']) {
                $this->updatePasswords($updateUser, $requestForm);
            }

            if (isset($requestForm['del_foto'])) {
                $requestForm = $this->deleteAvatar($updateUser, $requestForm);
            }

            if ($request->hasFile('photo')) {
                $requestForm = $this->uploadAvatar($updateUser, $requestForm);
            }

            return $updateUser->update($requestForm);
        }
    }
}
