<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Admin
 */
class AdminController extends AdminBaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $anime = [];

        return view('admin.main', compact('anime'));
    }
}
