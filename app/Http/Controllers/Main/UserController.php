<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Main
 */
class UserController extends Controller
{
	/**
	 * @var UserRepositoryInterface
	 */
	private static $userRepository;
	private static $keyCache = 'user_';

	/**
	 * UserController constructor.
	 *
	 * @param  UserRepositoryInterface  $repository
	 */
	public function __construct(UserRepositoryInterface $repository)
	{
		parent::__construct();
		self::$userRepository = $repository;
	}


	/**
	 * Просмотр профиля пользователя $userUrl
	 *
	 * @param  string  $userUrl
	 *
	 * @return View|void
	 */
	public function view($userUrl)
	{
		if (Cache::has(self::$keyCache . $userUrl)) {
			$profile = Cache::get(self::$keyCache . $userUrl);
		} else {
			$profile = self::setCache(self::$keyCache . $userUrl, self::$userRepository->getUsers($userUrl));
		}

		$country = self::loadCountryTimeZone(self::$countryRepository->getCountry(['id', 'title']));

		if (empty($profile)) {
			return abort(404);
		}

		return view(self::$theme . '/profile.profile', compact('profile', 'country'));
	}

	/**
	 * Обновление профиля $currentUser
	 *
	 * @param  UserRequest  $request
	 * @param  string       $currentUser
	 *
	 * @return RedirectResponse
	 */
	public function update(UserRequest $request, $currentUser): RedirectResponse
	{
		$requestUser = self::$userRepository->setUsers($request, $currentUser);

		if ($requestUser) {
			return redirect()->route('profile', $currentUser);
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}
}
