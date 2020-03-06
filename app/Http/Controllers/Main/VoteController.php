<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VoteRepositoryInterface;
use Illuminate\Http\RedirectResponse;

/**
 * Class VoteController
 *
 * @package App\Http\Controllers\Main
 */
class VoteController extends Controller
{
	/**
	 * @var VoteRepositoryInterface
	 */
	private static $voteRepository;

	/**
	 * VoteController constructor.
	 *
	 * @param  VoteRepositoryInterface  $voteRepository
	 */
	public function __construct(VoteRepositoryInterface $voteRepository)
	{
		parent::__construct();
		self::$voteRepository = $voteRepository;
	}

	/**
	 * @param $id
	 *
	 * @return RedirectResponse
	 */
	public function plus($id): RedirectResponse
	{
		self::$voteRepository->plusVotes($id);

		return back();
	}

	/**
	 * @param $id
	 *
	 * @return RedirectResponse
	 */
	public function minus($id): RedirectResponse
	{
		self::$voteRepository->minusVotes($id);

		return back();
	}
}
