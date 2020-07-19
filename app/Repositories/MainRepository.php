<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Anime;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use App\Repositories\Interfaces\MainRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MainRepository implements MainRepositoryInterface
{
    /**
     * Все посты
     *
     * @param $paginate
     *
     * @return LengthAwarePaginator
     */
    public function getAllAnime($paginate)
    {
        return Anime::with(['getCategory'])
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
    }

    /**
     * Получить все категории
     *
     * @return Category[]|Collection
     */
    public function getAllCategory()
    {
        return Category::withCount('getAnime')
            ->get();
    }

    /**
     * Посты категории
     *
     * @param $category
     * @param $paginate
     *
     * @return mixed
     */
    public function getCategoryAnime($category, $paginate)
    {
        return $category
            ->getAnime()
            ->with(['getCategory', 'getUsers:id,login'])
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
    }

    /**
     * Получить данные по категории
     *
     * @param $category
     *
     * @return mixed
     */
    public function getCategory($category)
    {
        return Category::where('url', $category)
            ->select(['id', 'title', 'url', 'description'])
            ->first();
    }

    /**
     * Полный пост аниме
     *
     * @param $anime
     *
     * @return Builder|Model|object|null
     */
    public function getFullAnime($anime)
    {
        return Anime::with(['getCategory', 'getUsers:id,login', 'getCountry'])
            ->where('url', $anime)
            ->first();
    }

    /**
     * Профиль пользователя
     *
     * @param $user
     *
     * @return Builder|Model|object|null
     */
    public function getUsers($user)
    {
        return User::with(['getGroup:id,title', 'getCountry:id,title'])
            ->where('login', $user)
            ->first();
    }

    /**
     * Получает все страны
     *
     * @param $selectRows
     *
     * @return mixed
     */
    public function getCountry($selectRows)
    {
        return Country::select($selectRows)
            ->get();
    }

    /**
     * Поиск по сайту
     *
     * @param Request $request
     * @param         $paginate
     *
     * @return LengthAwarePaginator|mixed
     */
    public function getSearch(Request $request, $paginate)
    {
        return Anime::with(['getCategory'])
            ->orWhere('title', 'LIKE', '%' . $request->story . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
    }

    /**
     * Вывод карусели
     *
     * @param $status
     * @param $count
     *
     * @return Builder[]|Collection|mixed
     */
    public function getStatus($status, $count)
    {
        /*$result = Anime::with(['getCategory'])
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();*/

        return $result = [];
    }

    /**
     * Вывод кустом
     *
     * @param $columns  string
     * @param $custom   string
     * @param $paginate int
     *
     * @return LengthAwarePaginator|mixed
     */
    public function getCustom($columns, $custom, $paginate)
    {
        return Anime::with(['getCategory'])
            ->where($columns, $custom)
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
    }
}
