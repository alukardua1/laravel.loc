<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface MainRepositoryInterface
{
    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function getAllAnimePost($paginate);

    /**
     * @return mixed
     */
    public function getAllCategory();

    /**
     * @param $category
     * @param $paginate
     *
     * @return mixed
     */
    public function getCategoryAnimePost($category, $paginate);

    /**
     * @param $category
     *
     * @return mixed
     */
    public function getCategory($category);

    /**
     * @param $anime
     *
     * @return mixed
     */
    public function getFullAnime($anime);

    /**
     * @param $user
     *
     * @return mixed
     */
    public function getUsers($user);

    /**
     * @return mixed
     */
    public function getCountry($selectRows);

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @param                            $paginate
     *
     * @return mixed
     */
    public function getSearch(Request $request, $paginate);

    /**
     * @param $status
     * @param $count
     *
     * @return mixed
     */
    public function getStatus($status, $count);

    /**
     * @param $columns
     * @param $custom
     * @param $paginate
     *
     * @return mixed
     */
    public function getCustom($columns, $custom, $paginate);
}
