<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Профиль пользователя
     *
     * @param $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($user)
    {
        $profile = self::$mainRepository->getUsers($user);
        $country = self::$mainRepository->getCountry(['id', 'title']);
        foreach ($country as $key => $value) {
            $result[$value['id']] = $value['title'];
        }
        $country = $result;
        $tz = self::getTimeZone();

        if (empty($profile)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Пользователь {$user} не найден"]);
        }
        return view(self::$theme.'/profile.profile', compact('profile', 'country', 'tz'));
    }

    /**
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User                $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProfile(UserRequest $request, $user): \Illuminate\Http\RedirectResponse
    {
        //dd(__METHOD__, $request);
        $result = self::$mainSetRepository::setUser($request, $user);

        if ($result) {
            return redirect()->route('profile', $user);
        }

        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }
}
