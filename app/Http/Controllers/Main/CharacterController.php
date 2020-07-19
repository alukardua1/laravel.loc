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
 * Class CharacterController
 *
 * @package App\Http\Controllers\Main
 */
class CharacterController extends Controller
{
    /**
     *
     */
    public function index()
    {
        dd(__METHOD__);
    }

    /**
     * @param $character
     */
    public function show($character)
    {
        dd(__METHOD__, $character);
    }
}
