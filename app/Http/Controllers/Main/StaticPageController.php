<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;
use Cache;
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
	private static $keyCache = 'page_';

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
	 * Выводит статическую страницу
	 *
	 * @param  string  $url
	 *
	 * @return Factory|View
	 */
	public function show($url)
	{
		if (Cache::has(self::$keyCache . $url)) {
			$staticPage = Cache::get(self::$keyCache . $url);
		} else {
			$staticPage = self::setCache(self::$keyCache . $url, self::$staticPageRepository->getStaticPage($url));
		}

		return view(self::$theme . '/staticPage', compact('staticPage'));
	}
}
