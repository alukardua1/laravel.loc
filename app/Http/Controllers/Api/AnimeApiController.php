<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\AnimeRepositoryInterface;
use App\Traits\FunctionsTrait;
use Illuminate\Http\Response;

/**
 * Class AnimeApiController
 *
 * @package App\Http\Controllers\Api
 */
class AnimeApiController extends BaseApiController
{
	use FunctionsTrait;

	/**
	 * @var \App\Repositories\Interfaces\AnimeRepositoryInterface
	 */
	private static $animeRepository;

	/**
	 * @var string[]
	 */
	private static $arr = [
		'get_category',
		'get_users',
		'get_translate',
		'get_country',
		'posted_at',
		'created_at',
		'updated_at',
		'user_id',
		'country_id',
	];

	/**
	 * AnimeApiController constructor.
	 *
	 * @param  \App\Repositories\Interfaces\AnimeRepositoryInterface  $repository
	 */
	public function __construct(AnimeRepositoryInterface $repository)
	{
		self::$animeRepository = $repository;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
	 */
	public function index()
	{
		$anime = self::$animeRepository->getAnime()->paginate(10)->jsonSerialize();
		foreach ($anime['data'] as $key => $value) {
			$value = $this->getMutation($value);
			$anime['data'][$key] = $value;
		}

		return response($anime, Response::HTTP_OK);
	}

	/**
	 * @param  array  $data
	 *
	 * @return array|mixed
	 */
	private function getMutation($data)
	{
		$siteUrl = url('/');
		$anime = [
			'id'             => (integer)$data['id'],
			'russian'        => $data['title'],
			'other_title'    => [
				'english'  => $data['english'],
				'japanese' => $data['japanese'],
				'romaji'   => $data['romaji'],
			],
			'poster'         => "{$siteUrl}/storage/anime/{$data['url']}/{$data['poster']}",
			'kind'           => $data['tip'],
			'rating'         => $data['rating'],
			'url'            => "{$siteUrl}/anime/{$data['id']}-{$data['url']}",
			'category'       => $this->getValueApi($data['get_category'], 'category'),
			'author'         => [
				'id'    => $data['get_users']['id'],
				'login' => $data['get_users']['login'],
			],
			'translate'      => $this->getValueApi($data['get_translate'], 'translate'),
			'country'        => [
				'id'    => $data['get_country']['id'],
				'title' => $data['get_country']['title'],
			],
			'aired_season'   => (integer)$data['aired_season'],
			'aired_on'       => $data['aired_on'],
			'released_on'    => $data['released_on'],
			'released'       => $data['released'],
			'delivery_time'  => $data['delivery_time'],
			'tv_canal'       => $data['tv_canal'],
			'duration'       => (integer)$data['duration'],
			'count_series'   => (integer)$data['count_series'],
			'external_links' => [
				'world_art'   => $this->externalLinks('world_art', $data['wa_id'], 'http://www.world-art.ru/animation/animation.php?id='),
				'shikimori'   => $this->externalLinks('shikimori', $data['shikimori_id'], 'https://shikimori.one/animes/'),
				'kinopoisk'   => $this->externalLinks('kinopoisk', $data['kp_id'], 'https://www.kinopoisk.ru/series/'),
				'myanimelist' => $this->externalLinks('myanimelist', $data['mal_id'], 'http://myanimelist.net/anime/'),
				'anime_db'    => $this->externalLinks('anime_db', $data['anidb_id'], 'https://anidb.net/perl-bin/animedb.pl?show=anime&aid='),
			],
			'content'        => $data['content'],
			'trailer'        => null,

		];
		//$anime = $this->apiUnset(self::$arr, $data);
		//dd(__METHOD__, $anime, $data, url('/'));
		return $anime;
	}

	/**
	 * @param  array  $data
	 *
	 * @return array
	 */
	private function getValueApi($data, $urlTag)
	{
		$siteUrl = url('/');
		$i = 0;
		$category = [];
		foreach ($data as $key => $value) {
			$url = $value['url'] ?? null;
			$category[$i] = [
				'id'           => (integer)$value['id'],
				'title'        => $value['title'],
				'category_url' => "{$siteUrl}/{$urlTag}/{$url}",
			];
			$i++;
		}

		return $category;
	}

	/**
	 * @param  string  $title
	 * @param  int     $id
	 * @param  string  $url
	 *
	 * @return array|null[]
	 */
	private function externalLinks($title, $id, $url)
	{
		if ($id) {
			$titles = [
				'title' => $title,
				'id'    => (integer)$id,
				'url'   => $url . $id,
			];

			return $titles;
		}
		$titles = [
			'title' => null,
			'id'    => null,
			'url'   => null,
		];

		return $titles;
	}

	public function view($id)
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
