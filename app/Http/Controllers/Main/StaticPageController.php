<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class StaticPageController
 *
 * @package App\Http\Controllers\Main
 */
class StaticPageController extends Controller
{
    /**
     * @var StaticPageRepositoryInterface
     */
    private static $staticPageRepository;

    /**
     * StaticPageController constructor.
     *
     * @param  StaticPageRepositoryInterface  $repository
     */
    public function __construct(StaticPageRepositoryInterface $repository)
    {
        parent::__construct();
        self::$staticPageRepository = $repository;
    }

    /**
     * @param $url
     *
     * @return Factory|View
     */
    public function view($url)
    {
        if (\Cache::has('page_'.$url)) {
            $staticPage = \Cache::get('page_'.$url);
        } else {
            $staticPage = self::setCache('page_'.$url, self::$staticPageRepository->getStaticPage($url));
        }

        return view(self::$theme.'/staticPage', compact('staticPage'));
    }
}
