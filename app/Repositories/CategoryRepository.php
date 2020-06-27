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
	 * @var string $setUrl Столбец поиска
	 */
	private static $setUrl = 'url';

	/**
	 * @var string $parentId Проверка родительской категории
	 */
	private static $parentId = 'parent_id';

	/**
	 * Выводит все записи категории
	 *
	 * @param  null  $url      Урл категории
	 *
	 * @param  bool  $isAdmin  Проверяет админка или нет
	 *
	 * @return mixed
	 */
	public function getCategory($url = null, $isAdmin = false)
	{
		$select = ['id', 'title', 'url', 'parent_id', 'description'];
		if ($url && $isAdmin) {
			return Category::where(self::$setUrl, $url)
				->with(['getCategory'])
				->select($select);
		}
		if ($url) {
			/** @var mixed $result текущая категория */
			$result = Category::where(self::$setUrl, $url)
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
	 * @param  Request  $request     Запрос POST
	 * @param  string   $url         Урл категории
	 *
	 * @var mixed       $requestForm Весь запрос
	 *
	 * @return mixed|void
	 */
	public function setCategory(Request $request, $url = null)
	{
		$requestForm = $request->all();
		if ($url) {
			$updateCategory = Category::where(self::$setUrl, $url)->first();
		} else {
			$updateCategory = Category::create($requestForm);
		}
		if ($request[self::$parentId]) {
			$updateCategory->fill($request->except(self::$parentId));
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
	 * @return mixed
	 */
	public function delCategory($url)
	{
		/** @var \App\Models\Category $deleteCategory */
		$deleteCategory = Category::where(self::$setUrl, $url)->first();
		$deleteCategory->getAnime()->sync([]);

		return $deleteCategory->delete();
	}
}
