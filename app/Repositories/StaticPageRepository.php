<?php


namespace App\Repositories;


use App\Models\StaticPage;
use App\Repositories\Interfaces\StaticPageRepositoryInterface;

class StaticPageRepository implements StaticPageRepositoryInterface
{

    public function getStaticPage($url)
    {
        $result = StaticPage::where('url', $url)->first();

        return $result;
    }
}
