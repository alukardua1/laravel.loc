<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


/**
 * Interface TranslateRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface TranslateRepositoryInterface
{
	/**
	 * @param  null  $id
	 *
	 * @return mixed
	 */
	public function getTranslate($id = null);
}
