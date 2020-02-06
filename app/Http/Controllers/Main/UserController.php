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

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Main
 */
class UserController extends Controller
{
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
     * Профиль пользователя
     *
     * @param $user
     *
     * @var array $countryArray
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($user)
    {
        $profile = self::$userRepository->getUsers($user);
        if (empty($profile)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Пользователь {$user} не найден"]);
        }
        $countryArray = $this->loadDataUser()['countryArray'];
        $tz = $this->loadDataUser()['timeZone'];

        return view(self::$theme.'/profile.profile', compact('profile', 'countryArray', 'tz'));
    }

    /**
     * @return array
     */
    private function loadDataUser(): array
    {
        $countryArray = [];
        $countryRaw = self::$countryRepository->getCountry(['id', 'title']);
        foreach ($countryRaw as $key => $value) {
            $countryArray[$value['id']] = $value['title'];
        }
        $timeZone = self::getTimeZone();

        return ['countryArray' =>$countryArray, 'timeZone' =>$timeZone];
    }

    /**
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User                $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $user): \Illuminate\Http\RedirectResponse
    {
        $result = self::$userRepository->setUser($request, $user);

        if ($result) {
            return redirect()->route('profile', $user);
        }

        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }
}
