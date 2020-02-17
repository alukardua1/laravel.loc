<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Traits\UploadImage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class AnimeRepository
 *
 * @package App\Repositories
 */
class AnimeRepository implements AnimeRepositoryInterface
{
    use UploadImage;

    /**
     * @param  mixed  $url  Урл поста
     * @param  bool  $isAdmin  Проверяет откуда запрос (сайт или админка)
     *
     * @return Builder
     */
    public function getAnime($url = null, $isAdmin = false): Builder
    {
        if ($url) {
            /** выводит аниме по урл */
            return Anime::with(['getCategory'])
                ->where('id', $url)
                ->orderBy('created_at', 'DESC');
        }
        if ($isAdmin) {
            /** выводит все аниме для админки */
            return Anime::with(['getCategory', 'getUsers'])
                ->orderBy('created_at', 'DESC');
        }
        /** выводит все аниме на сайте */
        return Anime::with(['getCategory', 'getUsers'])
            ->where('posted_at', 1)
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @param  Request  $request
     * @param                            $url
     *
     * @return mixed
     * @var                              $update
     * @var                              $requestForm
     *
     * @var                              $updateAnime
     * @todo Попытатся перенести все в AnimeObserver
     */
    public function setAnime(Request $request, $url = null)
    {
        $update = [];
        $requestForm = $request->all();
        if ($url) {
            $updateAnime = Anime::where('id', $url)->first()->touch();
        } else {
            $updateAnime = Anime::create($requestForm);
        }
        //dd(__METHOD__, $updateAnime, $url);
        $updateAnime->fill($request->except('genre'));
        $updateAnime->save();
        $updateAnime->getCategory()->sync($request->genre);
        if ($request->hasFile('poster')) {
            $update = $this->uploadImages($updateAnime, $requestForm);
        }

        return $updateAnime->update($update);
    }

    /**
     * @param $url
     *
     * @return mixed
     */
    public function delAnime($url)
    {
        $deleteAnime = Anime::where('id', $url)->first();
        $deleteAnime->getCategory()->detach();
        return $deleteAnime->delete();
    }

    /**
     * Поиск по сайту
     *
     * @param  Request  $request
     * @return LengthAwarePaginator|mixed
     */
    public function getSearch(Request $request)
    {
        return Anime::with(['getCategory'])
            ->orWhere('title', 'LIKE', '%'.$request->story.'%')
            ->orWhere('japanese', 'LIKE', '%'.$request->story.'%')
            ->orWhere('english', 'LIKE', '%'.$request->story.'%')
            ->orWhere('romaji', 'LIKE', '%'.$request->story.'%')
            ->orderBy('created_at', 'DESC');
    }
}
