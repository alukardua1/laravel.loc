<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace App\Http\Controllers;

use App\Repository\Interfaces\DLEParse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParseDbDLEController extends Controller
{
    private $dleParseRepository;

    public function __construct(DLEParse $DLEParse)
    {
        $this->dleParseRepository = $DLEParse;
    }

    public function index()
    {
        $category = $this->dleParseRepository->parseCategory();
        $user = $this->dleParseRepository->parseUser();
        $post = $this->dleParseRepository->parsePost();
        $animeCategory = $this->dleParseRepository->parsePostCategory();
        $studios = $this->dleParseRepository->parseStudio();
        /*foreach ($category as $cat)
        {
            DB::table('categories')->insert($cat);
        }
        foreach ($post as $value)
        {
            DB::table('animes')->insert($value);
        }
        foreach ($animeCategory as $value)
        {
            DB::table('anime_category')->insert($value);
        }*/
        dd(__METHOD__, $post);
    }
}
