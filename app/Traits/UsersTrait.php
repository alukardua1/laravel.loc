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

/**
 * Trait UsersTrait
 *
 * @package App\Traits
 */
trait UsersTrait
{
	private static $avatarColumns  = 'photo';
	private static $avatarName     = 'photo_';
	private static $patchAvatar    = 'public/avatars/';
	private static $patchSeparator = '/';
	private static $oldPass        = 'old_password';
	private static $currentPass    = 'password';
	private static $newPass        = 'new_password';

	/**
	 * Загружает аватар в профиль
	 *
	 * @param  \App\Models\User  $updateUser   Current users
	 * @param  array             $requestForm  Request
	 *
	 * @return mixed Updated request
	 */
	public function uploadAvatar($updateUser, $requestForm)
	{
		if (file_exists(self::$patchAvatar . $updateUser->photo)) {
			$requestForm = $this->deleteAvatar($updateUser, $requestForm);
		}

		$Extension = $requestForm[self::$avatarColumns]->getClientOriginalExtension();
		$fileName = self::$avatarName . $updateUser->id . '.' . $Extension;

		Storage::putFileAs(
			self::$patchAvatar . $updateUser->login . self::$patchSeparator,
			$requestForm[self::$avatarColumns],
			$fileName
		);

		$requestForm[self::$avatarColumns] = $updateUser->login . self::$patchSeparator . $fileName;

		return $requestForm;
	}

	/**
	 * Удаляет текущий аватар
	 *
	 * @param  \App\Models\User  $updateUser   Current users
	 * @param  array             $requestForm  Request
	 *
	 * @return array
	 */
	private function deleteAvatar($updateUser, $requestForm): array
	{
		Storage::delete(self::$patchAvatar . $updateUser->photo);
		$requestForm[self::$avatarColumns] = '';

		return $requestForm;
	}

	/**
	 * Обновляет пароль
	 *
	 * @param  \App\Models\User  $updateUser   Current users
	 * @param  array             $requestForm  Request
	 *
	 * @return string
	 */
	public function updatePasswords($updateUser, $requestForm): string
	{
		if (Hash::check($requestForm[self::$oldPass], $updateUser[self::$currentPass])) {
			return $requestForm[self::$currentPass] = Hash::make($requestForm[self::$newPass]);
		}
		return back()->withErrors(['msg' => Lang::get('errors.passError')])->withInput();
	}

	/**
	 * @param  \App\Models\User  $user
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
