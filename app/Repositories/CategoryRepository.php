<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @param  null  $url
     *
     * @return mixed
     */
    public function getCategory($url = null)
    {
        if ($url) {
            $result = Category::where('url', $url)
                ->select(['id', 'title', 'url'])
                ->first()
                ->getAnime()
                ->with(['getCategory', 'getUsers:id,login'])
                ->orderBy('created_at', 'DESC');
        } else {
            $result = Category::withCount('getAnime');
        }

        return $result;
    }
}
