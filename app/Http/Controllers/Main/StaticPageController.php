<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;

/**
 * Class StaticPageController
 *
 * @package App\Http\Controllers\Main
 */
class StaticPageController extends Controller
{
    /**
     * @var \App\Repositories\Interfaces\StaticPageRepositoryInterface
     */
    private static $staticPageRepository;

    /**
     * StaticPageController constructor.
     *
     * @param  \App\Repositories\Interfaces\StaticPageRepositoryInterface  $repository
     */
    public function __construct(StaticPageRepositoryInterface $repository)
    {
        parent::__construct();
        self::$staticPageRepository = $repository;
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
