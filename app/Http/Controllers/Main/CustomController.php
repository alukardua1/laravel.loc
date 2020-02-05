<?php


namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    public function tip($tip)
    {
        $animePost = self::$customRepository->getCustom('*', 'tip', $tip)->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }

    public function year($aired_season)
    {
        $animePost = self::$customRepository->getCustom('*', 'aired_season', $aired_season)->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }
}
