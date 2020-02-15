<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Models\Category;
use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Traits\UploadImage;
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
     * @param  mixed  $url
     * @param  bool   $isAdmin
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAnime($url = null, $isAdmin = false): \Illuminate\Database\Eloquent\Builder
    {
        if ($url) {
            return Anime::with(['getCategory'])
                ->where('id', $url)
                ->orderBy('created_at', 'DESC');
        }
        if ($isAdmin) {
            return Anime::with(['getCategory', 'getUsers'])
                ->orderBy('created_at', 'DESC');
        }

        return Anime::with(['getCategory', 'getUsers'])
            ->where('posted_at', 1)
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
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
        if ($url)
        {
            $updateAnime = Anime::where('url', $url)->first();
        }else{
            $updateAnime = Anime::create($requestForm);
        }
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
        $deleteAnime = Anime::where('url', $url)->first();
        $deleteAnime->getCategory()->detach();
        return $deleteAnime->delete();
    }
}
