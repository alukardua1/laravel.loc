<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;

/**
 * Class CountryRepository
 *
 * @package App\Repositories
 */
class CountryRepository implements CountryRepositoryInterface
{
	/**
	 * Выбирает все записи
	 *
	 * @param  array  $selectColumns
	 *
	 * @return mixed
	 */
	public function getCountry($selectColumns)
	{
		return Country::select($selectColumns)
			->get();
	}
}
