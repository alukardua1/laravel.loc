<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


use Carbon\Carbon;
use Hash;
use Lang;
use Storage;
use App\Models\User;

/**
 * Trait UsersTrait
 *
 * @package App\Traits
 */
trait UsersTrait
{
    /**
     * Все настройки
     *
     * @var array
     */
    private static $config;

    /**
     * UsersTrait constructor.
     */
    public function __construct()
    {
        self::$config = config('avatarConfig');
        self::$config['patchSeparator'] = config('appSecondConfig.patchSeparator');
    }

    /**
     * Загружает аватар в профиль
     *
     * @param User  $updateUser  Current users
     * @param array $requestForm Request
     *
     * @return mixed Updated request
     */
    public function uploadAvatar($updateUser, $requestForm)
    {
        if (file_exists(self::$config['patchAvatar'] . $updateUser->photo)) {
            $requestForm = $this->deleteAvatar($updateUser, $requestForm);
        }

        $Extension = $requestForm[self::$config['avatarColumns']]->getClientOriginalExtension();
        $fileName = self::$config['avatarName'] . $updateUser->id . '.' . $Extension;

        Storage::putFileAs(
            self::$config['patchAvatar'] . $updateUser->login . self::$config['patchSeparator'],
            $requestForm[self::$config['avatarColumns']],
            $fileName
        );

        $requestForm[self::$config['avatarColumns']] = $updateUser->login . self::$config['patchSeparator'] . $fileName;

        return $requestForm;
    }

    /**
     * Удаляет текущий аватар
     *
     * @param User  $updateUser  Current users
     * @param array $requestForm Request
     *
     * @return array
     */
    private function deleteAvatar($updateUser, $requestForm): array
    {
        Storage::delete(self::$config['patchAvatar'] . $updateUser->photo);
        $requestForm[self::$config['avatarColumns']] = '';

        return $requestForm;
    }

    /**
     * Обновляет пароль
     *
     * @param User  $updateUser  Current users
     * @param array $requestForm Request
     *
     * @return string
     */
    public function updatePasswords($updateUser, $requestForm): string
    {
        if (Hash::check($requestForm[self::$config['oldPass']], $updateUser[self::$config['currentPass']])) {
            return $requestForm[self::$config['currentPass']] = Hash::make($requestForm[self::$config['newPass']]);
        }
        return back()->withErrors(['msg' => Lang::get('errors.passError')])->withInput();
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function refactoringUser($user)
    {
        switch ($user->getGroup->id) {
            case 1:
                $user->group = "<p class=\"red-text\">{$user->getGroup->title}</p>";
                break;
            case 2:
                $user->group = "<p class=\"green-text\">{$user->getGroup->title}</p>";
                break;
            case 3:
                $user->group = "<p class=\"brown-text\">{$user->getGroup->title}</p>";
                break;
        }
        $user->age = Carbon::now()->diffInYears($user->date_of_birth);
        if (!isset($user->name)) {
            $user->name = Lang::get('errors.noInputs');
        }
        $user->date_of_birth = Carbon::parse($user->date_of_birth)->format('d.m.Y');
        $user->register = Carbon::parse($user->created_at)->format('d.m.Y');

        return $user;
    }
}
