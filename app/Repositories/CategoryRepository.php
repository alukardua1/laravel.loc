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
use Throwable;

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
		$select = ['id', 'title', 'url', 'parent_id', 'description'];
		if ($url && $isAdmin) {
			return Category::where('url', $url)
				->with(['getCategory'])
				->select($select);
		}
		if ($url) {
			/** @var mixed $result текущая категория */
			$result = Category::where('url', $url)
				->select($select)
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
	 * Сохраняет категории
	 *
	 * @param  Request  $request
	 * @param  string   $url
	 *
	 * @return mixed|void
	 */
	public function setCategory(Request $request, $url = null)
	{
		$requestForm = $request->all();
		if ($url) {
			$updateCategory = Category::where('url', $url)->first();
		} else {
			$updateCategory = Category::create($requestForm);
		}
		if ($request['parent_id']) {
			$updateCategory->fill($request->except('parent_id'));
			$updateCategory->save();
		}
		$updateCategory->touch();

		return $updateCategory->update($requestForm);
	}

	/**
	 * Удаляет категории
	 *
	 * @param  string  $url  Url category
	 *
	 * @throws Throwable
	 * @return bool|null
	 */
	public function delCategory($url)
	{
		/** @var \App\Models\Category $deleteCategory */
		$deleteCategory = Category::where('url', $url)->first();
		$deleteCategory->getAnime()->sync([]);

		return $deleteCategory->delete();
	}
}
