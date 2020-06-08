<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Traits\UploadImageTrait;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Concerns\BuildsQueries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class AnimeRepository
 *
 * @package App\Repositories
 */
class AnimeRepository implements AnimeRepositoryInterface
{
	use UploadImageTrait;

	/**
	 * если $id пустой выводит все записи на сайте, $isAdmin если указан то выводит в админке, если $id указан то
	 * выведет одну запись
	 *
	 * @param  int   $id       id поста
	 * @param  bool  $isAdmin  Проверяет откуда запрос (сайт или админка)
	 *
	 * @return Builder
	 */
	public function getAnime($id = null, $isAdmin = false): Builder
	{
		if ($id) {
			/** выводит аниме по урл */
			return Anime::with(['getCategory', 'getUsers', 'getTranslate'])
				->where('id', $id)
				->orderBy('created_at', 'DESC');
		}
		if ($isAdmin) {
			/** выводит все аниме для админки */
			return Anime::with(['getCategory', 'getUsers', 'getTranslate'])
				->orderBy('created_at', 'DESC');
		}
		/** выводит все аниме на сайте */
		return Anime::with(['getCategory', 'getUsers', 'getTranslate'])
			->where('posted_at', 1)
			->orderBy('created_at', 'DESC');
	}

	/**
	 * Обновление и добавление записи в базу
	 *
	 * @param  \Illuminate\Http\Request  $request  запрос из формы
	 * @param  int                       $id       id записи
	 *
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 *
	 * @return mixed
	 * @todo Попытатся перенести все в AnimeObserver
	 */
	public function setAnime(Request $request, $id = null)
	{
		/**
		 * @var \App\Models\Anime $updateAnime
		 * @var mixed             $requestForm
		 */
		$update = [];
		$requestForm = $request->all();
		if ($id) {
			$updateAnime = Anime::where('id', $id)->first();
			Cache::delete('anime_' . $id);
		} else {
			$updateAnime = Anime::create($requestForm);
		}

		if ($request['genre']) {
			$updateAnime->fill($request->except('genre'));
			$updateAnime->save();
			$updateAnime->getCategory()->sync($request['genre']);
		}
		if ($request['translate']) {
			$updateAnime->fill($request->except('translate'));
			$updateAnime->save();
			$updateAnime->getTranslate()->sync($request['translate']);
		}
		if ($request->hasFile('poster')) {
			$update = $this->uploadImages($updateAnime, $requestForm);
		}
		$updateAnime->touch();

		return $updateAnime->update($update);
	}

	/**
	 * Удаляет запись из базы
	 *
	 * @param  mixed  $id  id записи
	 *
	 * @throws InvalidArgumentException
	 * @throws \Throwable
	 * @return mixed
	 */
	public function delAnime($id)
	{
		/**
		 * @var \App\Models\Anime $deleteAnime
		 */
		$deleteAnime = Anime::where('id', $id);
		$deleteAnime = $deleteAnime->first();
		$deleteAnime->getTranslate()->sync([]);
		$deleteAnime->getCategory()->sync([]);
		Cache::delete('anime_' . $id);

		return $deleteAnime->delete();
	}

	/**
	 * Поиск по сайту
	 *
	 * @param  Request  $request
	 *
	 * @return LengthAwarePaginator|mixed
	 */
	public function getSearch(Request $request)
	{
		/**
		 * @var mixed $request ->story
		 */
		return Anime::with(['getCategory'])
			->orWhere('title', 'LIKE', "%{$request->story}%")
			->orWhere('japanese', 'LIKE', "%{$request->story}%")
			->orWhere('english', 'LIKE', "%{$request->story}%")
			->orWhere('romaji', 'LIKE', "%{$request->story}%")
			->orderBy('created_at', 'DESC');
	}

	public function sortAnime(Request $request)
    {
        // TODO: Implement sortAnime() method.
    }
}
