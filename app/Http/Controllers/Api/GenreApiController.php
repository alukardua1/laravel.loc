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
	    self::$categoryRepository = $repository;
    }

    public function index()
    {
	    //$category = self::$categoryRepository->getCategory()->get();
	    return response($category = self::$categoryRepository->getCategory()->get()->jsonSerialize(), Response::HTTP_OK);
    	/*$category = self::$categoryRepository->getCategory()->get();
    	return $category;*/
    }
}
