<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Observers;

use App\Models\Category;
use Str;

/**
 * Class CategoryObserver
 *
 * @package App\Observers
 */
class CategoryObserver
{
	/**
	 * @param  \App\Models\Category  $category
	 */
	public function updating(Category $category)
	{
		$category->url = Str::slug($category->title);
	}

	/**
	 * @param  \App\Models\Category  $category
	 */
	public function creating(Category $category)
	{
		$category->url = Str::slug($category->title);
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updated()
	{
		return redirect()->route('admin.category')->send();
	}
}
