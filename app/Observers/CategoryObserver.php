<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Observers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Str;

/**
 * Class CategoryObserver
 *
 * @package App\Observers
 */
class CategoryObserver
{
    /**
     * @param Category $category
     */
    public function updating(Category $category)
    {
        $category->url = Str::slug($category->title);
    }

    /**
     * @param Category $category
     */
    public function creating(Category $category)
    {
        $category->url = Str::slug($category->title);
    }

    /**
     * @return RedirectResponse
     */
    public function updated()
    {
        return redirect()->route('admin.category')->send();
    }
}
