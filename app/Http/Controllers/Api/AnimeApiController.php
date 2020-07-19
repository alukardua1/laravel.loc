<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\AnimeRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * Class AnimeApiController
 *
 * @package App\Http\Controllers\Api
 */
class AnimeApiController extends BaseApiController
{


    /**
     * @var AnimeRepositoryInterface
     */
    private static $animeRepository;

    /**
     * AnimeApiController constructor.
     *
     * @param AnimeRepositoryInterface $repository
     */
    public function __construct(AnimeRepositoryInterface $repository)
    {
        parent::__construct();
        self::$animeRepository = $repository;
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        $anime = self::$animeRepository->getAnime()->paginate(self::$paginate)->jsonSerialize();
        foreach ($anime['data'] as $key => $value) {
            $value = $this->getMutation($value);
            $anime['data'][$key] = $value;
        }

        return response($anime, Response::HTTP_OK);
    }

    /**
     * @param $id
     *
     * @return Application|ResponseFactory|Response
     */
    public function show($id)
    {
        if ((integer)$id > 0) {
            $anime = self::$animeRepository->getAnime($id)->first();
            if ($anime) {
                $anime = $anime->jsonSerialize();
                $anime = $this->getMutation($anime);

                return response($anime, Response::HTTP_OK);
            }

            return response($this->api404(), Response::HTTP_OK);
        }

        return response($this->api404(), Response::HTTP_OK);
    }
}
