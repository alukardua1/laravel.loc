<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface CommentsRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface CommentsRepositoryInterface
{
	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getComments($id);

	/**
	 * @param  Request  $request
	 * @param           $id
	 *
	 * @return mixed
	 */
	public function setComments(Request $request, $id = null);

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function delComments($id);

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function countComments($id);
}
