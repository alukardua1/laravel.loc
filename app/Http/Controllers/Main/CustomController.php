<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CustomController
 *
 * @package App\Http\Controllers\Main
 */
class CustomController extends Controller
{
    /**
     * @param  string  $columns   DB columns
     * @param  string  $variable  Search variable
     *
     * @return Factory|View
     */
    public function loadCustom($columns, $variable)
    {
        $animePost = self::$customRepository
            ->getCustom('*', $columns, $variable)
            ->paginate(self::$paginate);

        return view(self::$theme.'/home', compact('animePost'));
    }
}
