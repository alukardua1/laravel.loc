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
use Illuminate\Http\Request;

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
		$allCategory = self::$categoryRepository->getCategory()->get();

		return view('admin.category.index', compact('category', 'allCategory'));
	}

	/**
	 * @param  string  $url
	 *
	 * @return Factory|View
	 */
	public function edit($url)
	{
		$category = self::$categoryRepository->getCategory($url, true)->first();
		$allCategory = self::$categoryRepository->getCategory()->get();

		return view('admin.category.edit', compact('category', 'allCategory'));
	}

	/**
	 * @param  Request  $request
	 * @param  string   $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $url): RedirectResponse
	{
		$updateCategory = self::$categoryRepository->setCategory($request, $url);

		if ($updateCategory) {
			return redirect()->route('admin.category');
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$allCategory = self::$categoryRepository->getCategory()->get();

		return view('admin.category.add', compact('allCategory'));
	}

	/**
	 * @param  Request  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$updateCategory = self::$categoryRepository->setCategory($request);
		if ($updateCategory) {
			return redirect()->route('admin.category');
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * @param  string  $url
	 *
	 * @return RedirectResponse
	 */
	public function delete($url): RedirectResponse
	{
		$deleteCategory = self::$categoryRepository->delCategory($url);
		if ($deleteCategory) {
			return redirect()->route('admin.category');
		}

		return back()->withErrors(['msg' => 'Ошибка удаления'])->withInput();
	}
}
