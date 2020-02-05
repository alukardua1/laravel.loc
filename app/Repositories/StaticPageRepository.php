<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\StaticPage;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;

class StaticPageRepository implements StaticPageRepositoryInterface
{

    /**
     * @param $url
     *
     * @return mixed
     */
    public function getStaticPage($url)
    {
        $result = StaticPage::where('url', $url)->first();

        return $result;
    }
}
