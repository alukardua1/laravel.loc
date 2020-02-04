<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MainRepositoryInterface;

class AdminController extends Controller
{
    private $animeRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Interfaces\MainRepositoryInterface  $mainRepository
     */
    public function __construct(MainRepositoryInterface $mainRepository)
    {
        $this->animeRepository = $mainRepository;
        //$this->middleware('auth');
    }

    public function index()
    {
        $anime = $this->animeRepository->getAllAnimePost(5);

        return view('admin.main', compact('anime'));
    }
}
