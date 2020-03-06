<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


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
	 * @param  array  $updateUser   Current users
	 * @param  array  $requestForm  Request
	 *
	 * @return mixed Updated request
	 */
	public function uploadAvatar($updateUser, $requestForm)
	{
		if (file_exists(self::$patchAvatar.$updateUser->photo)) {
			$requestForm = $this->deleteAvatar($updateUser, $requestForm);
		}

		$Extension = $requestForm[self::$avatarColumns]->getClientOriginalExtension();
		$fileName = self::$avatarName.$updateUser->id.'.'.$Extension;

		Storage::putFileAs(
			self::$patchAvatar.$updateUser->login.self::$patchSeparator,
			$requestForm[self::$avatarColumns],
			$fileName
		);

		$requestForm[self::$avatarColumns] = $updateUser->login.self::$patchSeparator.$fileName;

		return $requestForm;
	}

	/**
	 * Удаляет текущий аватар
	 *
	 * @param  array  $updateUser   Current users
	 * @param  array  $requestForm  Request
	 *
	 * @return mixed|void Updated request
	 */
	public function deleteAvatar($updateUser, $requestForm)
	{
		Storage::delete(self::$patchAvatar.$updateUser->photo);
		$requestForm[self::$avatarColumns] = '';

		return $requestForm;
	}

	/**
	 * Обновляет пароль
	 *
	 * @param  array  $updateUser   Current users
	 * @param  array  $requestForm  Request
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
}
