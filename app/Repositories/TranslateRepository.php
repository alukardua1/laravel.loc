<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Translate;
use App\Repositories\Interfaces\TranslateRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TranslateRepository
 *
 * @package App\Repositories
 */
class TranslateRepository implements TranslateRepositoryInterface
{
	/**
	 * @param  null  $id
	 *
	 * @return Translate[]|Collection|void
	 */
	public function getTranslate($id = null)
	{
		if ($id) {
			return abort(404);
		}

		return Translate::all();
	}
}
