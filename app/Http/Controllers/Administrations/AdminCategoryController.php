<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class AdminCategoryController extends AdminBaseController
{
    /**
     * @var \App\Repositories\Interfaces\CategoryRepositoryInterface
     */
    protected static $categoryRepository;

    /**
     * AdminCategoryController constructor.
     *
     * @param  \App\Repositories\Interfaces\CategoryRepositoryInterface  $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct();
        self::$categoryRepository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $category = self::$categoryRepository->getCategory()->paginate(self::$paginate);

        return view('admin.category.index', compact('category'));
    }
}
