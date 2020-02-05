<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     *
     */
    public function index()
    {

    }

    /**
     * @param $url
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($url)
    {
        $staticPage = self::$staticPageRepository->getStaticPage($url);

        return view(self::$theme.'/staticPage', compact('staticPage'));
    }
}
