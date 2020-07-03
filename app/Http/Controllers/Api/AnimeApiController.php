<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\AnimeRepositoryInterface;
use Illuminate\Http\Response;

class AnimeApiController extends BaseApiController
{
	private static $animeRepository;
	public function __construct(AnimeRepositoryInterface $repository)
	{
		self::$animeRepository = $repository;
	}

	public function index()
    {

    }

    public function view($id)
    {
	    return response($category = self::$animeRepository->getAnime($id)->first()->jsonSerialize(), Response::HTTP_OK);
    }
}
