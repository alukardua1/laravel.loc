<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return 'category';
    }

    public function view($url)
    {
        $animePost = self::$categoryRepository->getCategory($url)->paginate(self::$paginate);
        $categories = self::$categoryRepository->getCategory($url)->getParent();
        //$animePost = $categories->getRelation('getAnime');
        //dd(__METHOD__, $animePost, $categories, $url);
        if (empty($animePost)) {
            return view(self::$theme.'/errors.error')->withErrors(['msg' => "Категория {$url} не найдена"]);
        }
        //$animePost = self::$mainRepository->getCategoryAnimePost($categories, 10);


        return view(self::$theme.'/home', compact('animePost', 'categories'));
    }
}
