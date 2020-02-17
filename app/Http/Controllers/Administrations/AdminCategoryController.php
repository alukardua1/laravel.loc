<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Request;

class AdminCategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected static $categoryRepository;

    /**
     * AdminCategoryController constructor.
     *
     * @param  CategoryRepositoryInterface  $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct();
        self::$categoryRepository = $repository;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $category = self::$categoryRepository->getCategory()->paginate(self::$paginate);

        return view('admin.category.index', compact('category'));
    }

    public function edit($url)
    {
        $category = self::$categoryRepository->getCategory($url, true)->first();

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $url)
    {
        dd(__METHOD__, $request, $url);
    }

    public function create()
    {
        dd(__METHOD__);
    }

    public function store(Request $request)
    {
        dd(__METHOD__, $request);
    }

    public function delete($url)
    {
        dd(__METHOD__, $url);
    }
}
