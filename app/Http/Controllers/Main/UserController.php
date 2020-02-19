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
        if (Cache::has('user_'.$userUrl)) {
            $profile = Cache::get('user_'.$userUrl);
        } else {
            $profile = self::setCache('user_'.$userUrl, self::$userRepository->getUsers($userUrl));
        }

        $countryArray = $this->loadCountryTimeZone()['countryArray'];

        $tz = $this->loadCountryTimeZone()['timeZone'];

        if (empty($profile)) {
            return view(self::$theme.'/errors.profile')->withErrors(['msg' => "Пользователь {$userUrl} не найден"]);
        }

        return view(self::$theme.'/profile.profile', compact('profile', 'countryArray', 'tz'));
    }

    /**
     * Загружает временные зоны
     *
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
