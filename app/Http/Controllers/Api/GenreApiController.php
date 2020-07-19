<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * Class GenreApiController
 *
 * @package App\Http\Controllers\Api
 */
class GenreApiController extends BaseApiController
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected static $categoryRepository;

    /**
     * GenreApiController constructor.
     *
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct();
        self::$categoryRepository = $repository;
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        $category = self::$categoryRepository->getApiCategory()->get()->jsonSerialize();
        return response($category, Response::HTTP_OK);
    }

    /**
     * @param $url
     *
     * @return Application|ResponseFactory|Response
     */
    public function show($url)
    {
        $category = self::$categoryRepository->getApiCategory($url)->first()->jsonSerialize();
        return response($category, Response::HTTP_OK);
    }
}
