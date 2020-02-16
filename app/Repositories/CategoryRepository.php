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
     * Выводит все записи категории
     *
     * @param null $url
     *
     * @return mixed
     */
    public function getCategory($url = null)
    {
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
}
