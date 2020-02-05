<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MainRepositoryInterface;

class AdminController extends Controller
{
    public function index()
    {
        $anime = [];

        return view('admin.main', compact('anime'));
    }
}
