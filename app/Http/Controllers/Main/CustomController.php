<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    /**
     * @param $tip
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tip($tip)
    {
        $animePost = self::$customRepository->getCustom('*', 'tip', $tip)->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }

    /**
     * @param $aired_season
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function year($aired_season)
    {
        $animePost = self::$customRepository->getCustom('*', 'aired_season', $aired_season)->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }
}
