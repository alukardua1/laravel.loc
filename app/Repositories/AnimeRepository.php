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
                ->where('url', $url)
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

    public function setAnime(Request $request, $url)
    {
        $update = [];
        $updateAnime = Anime::where('url', $url)->first();
        $requestForm = $request->all();
        $updateAnime->fill($request->except('genre'));
        $updateAnime->save();
        $updateAnime->getCategory()->sync($request->genre);
        if ($request->hasFile('poster')) {
            $update = $this->uploadImages($updateAnime, $requestForm);
        }

        return $updateAnime->update($update);
    }
}
