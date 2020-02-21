<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Administrations;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Request;

/**
 * Class AdminCategoryController
 *
 * @package App\Http\Controllers\Administrations
 */
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

    /**
     * @param $url
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($url)
    {
        $category = self::$categoryRepository->getCategory($url, true)->first();

        return view('admin.category.edit', compact('category'));
    }

    /**
     * @param  \Request  $request
     * @param            $url
     */
    public function update(Request $request, $url)
    {
        dd(__METHOD__, $request, $url);
    }

    /**
     *
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * @param  \Request  $request
     */
    public function store(Request $request)
    {
        dd(__METHOD__, $request);
    }

    /**
     * @param $url
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($url): RedirectResponse
    {
        $deleteCategory = self::$categoryRepository->delCategory($url);
        if ($deleteCategory)
        {
            return redirect()->route('admin.category');
        }

        return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
    }
}
