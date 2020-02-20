<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class PeopleController
 *
 * @package App\Http\Controllers\Main
 */
class PeopleController extends Controller
{
    public function index()
    {
        dd(__METHOD__);
    }

    public function view($people)
    {
        dd(__METHOD__, $people);
    }
}
