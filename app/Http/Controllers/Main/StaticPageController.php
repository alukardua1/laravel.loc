<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index()
    {

    }

    public function view($url)
    {
        $staticPage = self::$staticPageRepository->getStaticPage($url);

        return view(self::$theme.'/staticPage', compact('staticPage'));
    }
}
