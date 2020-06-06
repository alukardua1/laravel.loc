<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Middleware;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CustomRepositoryInterface;
use App\Traits\CreateCacheTrait;
use App\Traits\FunctionsTrait;
use Cache;
use Closure;
use Menu;

/**
 * Class GenerateMenus
 *
 * @package App\Http\Middleware
 */
class GenerateMenus
{
	use CreateCacheTrait;
	use FunctionsTrait;

	/**
	 * @var \App\Repositories\Interfaces\CategoryRepositoryInterface
	 */
	private static $categoryRepository;
	/**
	 * @var mixed $globalCategory
	 */
	private static $globalCategory;
	/**
	 * @var \App\Repositories\Interfaces\CustomRepositoryInterface
	 */
	private static $customRepository;
	/**
	 * @var mixed $yearCustom
	 */
	private static $yearCustom;

	/**
	 * GenerateMenus constructor.
	 *
	 * @param  \App\Repositories\Interfaces\CategoryRepositoryInterface  $categoryRepository
	 * @param  \App\Repositories\Interfaces\CustomRepositoryInterface    $customRepository
	 */
	public function __construct(CategoryRepositoryInterface $categoryRepository, CustomRepositoryInterface $customRepository)
	{
		self::$categoryRepository = $categoryRepository;
		self::$customRepository = $customRepository;
	}

	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (Cache::has('globalCategory')) {
			self::$globalCategory = Cache::get('globalCategory');
		}else{
			self::$globalCategory = self::setCache('globalCategory', self::$categoryRepository->getCategory()->get());
		}
		if (Cache::has('aired_season')) {
			self::$yearCustom = Cache::get('aired_season');
		}else{
			self::$yearCustom = self::setCache('aired_season', self::$customRepository->getCustom('aired_season')->get());
		}

		/** Формирует категории */
    	Menu::make('globalCategory', function($menu){
			foreach (self::$globalCategory as $key => $value)
			{
				$menu->add("<p class=\"float-left mb-0\">{$value->title}</p>" , ['route' => ['category', $value->url], 'class' => 'list-group-item clearfix' ])
					->append(" <span class=\"badge teal badge-pill font-small float-right\">{$value->get_anime_count}</span>");
			}
		});
    	
		/** Формирует кустом */
		Menu::make('yearCustom', function($menu){

			self::$yearCustom = self::customArr(self::$yearCustom, 'aired_season');

			foreach (self::$yearCustom as $key => $value)
			{
				$menu->add("<p class=\"float-left mb-0\">{$key}</p>" , ['route' => ['category', $key], 'class' => 'list-group-item clearfix' ])
					->append(" <span class=\"badge teal badge-pill font-small float-right\">{$value}</span>");
			}
		});

        return $next($request);
    }
}
