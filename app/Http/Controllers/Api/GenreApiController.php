<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Response;

class GenreApiController extends BaseApiController
{
	protected static $categoryRepository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
	    parent::__construct();
	    self::$categoryRepository = $repository;
    }

    public function index()
    {
	    $category = self::$categoryRepository->getApiCategory()->get()->jsonSerialize();
	    return response($category, Response::HTTP_OK);
    }

    public function show($url)
    {
	    $category = self::$categoryRepository->getApiCategory($url)->first()->jsonSerialize();
	    return response($category, Response::HTTP_OK);
    }
}
