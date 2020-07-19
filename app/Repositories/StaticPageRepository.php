<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\StaticPage;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;

/**
 * Class StaticPageRepository
 *
 * @package App\Repositories
 */
class StaticPageRepository implements StaticPageRepositoryInterface
{
    /**
     * Выводит текущую статическую страницу
     *
     * @param mixed $url
     *
     * @return mixed
     */
    public function getStaticPage($url)
    {
        return StaticPage::where('url', $url)->first();
    }
}
