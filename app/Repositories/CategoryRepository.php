<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class CategoryRepository
 *
 * @package App\Repositories
 */
class CategoryRepository implements CategoryRepositoryInterface
{
	/**
	 * Выводит все записи категории
	 *
	 * @param  null  $url
	 *
	 * @param  bool  $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategory($url = null, $isAdmin = false)
	{
		if ($url && $isAdmin) {
			return Category::where('url', $url)
				->select(['id', 'title', 'url']);
		}
		if ($url) {
			/** @var mixed $result текущая категория */
			$result = Category::where('url', $url)
				->select(['id', 'title', 'url'])
				->first();
			if ($result) {
				/** @var mixed $anime все записи текущей категории если найдена категория */
				$anime = $result->getAnime()
					->with(['getCategory', 'getUsers:id,login'])
					->orderBy('created_at', 'DESC');

				return $anime;
			}
			/** Возвращает ошибку 404 если категория не найдена */
			return abort(404);
		}
		/** Возвращает количество постов для категории */
		return Category::withCount('getAnime');
	}

	/**
	 * @param  Request  $request
	 * @param  null      $url
	 *
	 * @return mixed|void
	 */
	public function setCategory(Request $request, $url = null)
	{
		// TODO: Implement setCategory() method.
	}

	/**
	 * @param  string  $url  Url category
	 *
	 * @return mixed|void
	 */
	public function delCategory($url)
	{
		$deleteCategory = Category::where('url', $url)->first();
		$deleteCategory->getAnime()->sync([]);

		return $deleteCategory->delete();
	}
}
