<?php


namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    public function tip($tip)
    {
        $animePost = self::$customRepository->getCustom('tip', $tip, self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }
}
