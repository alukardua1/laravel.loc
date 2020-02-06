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
use Illuminate\Http\RedirectResponse;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Main
 */
class UserController extends Controller
{
    /**
     * @var \App\Repositories\Interfaces\UserRepositoryInterface
     */
    private static $userRepository;

    /**
     * UserController constructor.
     *
     * @param  \App\Repositories\Interfaces\UserRepositoryInterface  $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct();
        self::$userRepository = $repository;
    }


    /**
     * @param $userUrl
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($userUrl)
    {
        $profile = self::$userRepository->getUsers($userUrl);

        $countryArray = $this->loadCountryTimeZone()['countryArray'];

        $tz = $this->loadCountryTimeZone()['timeZone'];

        if (empty($profile)) {
            return view(self::$theme.'/errors.profile')->withErrors(['msg' => "Пользователь {$userUrl} не найден"]);
        }

        return view(self::$theme.'/profile.profile', compact('profile', 'countryArray', 'tz'));
    }

    /**
     * @return array
     */
    private function loadCountryTimeZone(): array
    {
        $countryArray = [];
        $countryRaw = self::$countryRepository->getCountry(['id', 'title']);
        foreach ($countryRaw as $key => $value) {
            $countryArray[$value['id']] = $value['title'];
        }
        $timeZone = self::getTimeZone();

        return ['countryArray' => $countryArray, 'timeZone' => $timeZone];
    }


    /**
     * @param  \App\Http\Requests\UserRequest  $request
     * @param                                  $currentUser
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
