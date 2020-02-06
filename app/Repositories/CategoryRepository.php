<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

/**
 * Class CategoryRepository
 *
 * @package App\Repositories
 */
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
            return Category::where('url', $url)
                ->select(['id', 'title', 'url'])
                ->first()
                ->getAnime()
                ->with(['getCategory', 'getUsers:id,login'])
                ->orderBy('created_at', 'DESC');
        }
        return Category::withCount('getAnime');
    }
}
