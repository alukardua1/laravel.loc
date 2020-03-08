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
use Illuminate\Contracts\View\Factory;
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
	 * @return Factory|View
	 */
	public function view($userUrl)
	{
		$profile = self::getCache('user_'.$userUrl, self::$userRepository->getUsers($userUrl));
		$country = self::loadCountryTimeZone(self::$countryRepository->getCountry(['id', 'title']));

		if (empty($profile)) {
			return view(self::$theme.'/errors.profile')->withErrors(['msg' => "Пользователь {$userUrl} не найден"]);
		}

		return view(self::$theme.'/profile.profile', compact('profile', 'country'));
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
