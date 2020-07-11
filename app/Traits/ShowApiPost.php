<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


/**
 * Trait ShowApiPost
 *
 * @package App\Traits
 */
trait ShowApiPost
{
	private static $urlSite;

	public function __construct()
	{
		self::$urlSite = url('/');
	}

	/**
	 * Создает массив для вывода Api
	 *
	 * @param  array  $data
	 *
	 * @return array|mixed
	 */
	public function getMutation($data)
	{
		$anime = [
			'id'             => (integer)$data['id'],
			'russian'        => $data['title'],
			'other_title'    => [
				'english'  => $data['english'],
				'japanese' => $data['japanese'],
				'romaji'   => $data['romaji'],
			],
			'poster'         => $this->isPoster($data['poster'], $data['url']),
			'kind'           => $data['tip'],
			'rating'         => $data['rating'],
			'url'            => self::$urlSite . "/anime/{$data['id']}-{$data['url']}",
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

		return $anime;
	}

	/**
	 * Создает ссылку на постер
	 *
	 * @param $poster
	 * @param $url
	 *
	 * @return string|null
	 */
	private function isPoster($poster, $url)
	{
		if ($poster)
		{
			return self::$urlSite . "/storage/anime/{$url}/{$poster}";
		}
		return null;
	}

	/**
	 * Возвращает массив парентов
	 *
	 * @param  array  $data
	 *
	 * @return array
	 */
	private function getValueApi($data, $urlTag)
	{
		$i = 0;
		$result = [];
		foreach ($data as $key => $value) {
			$url = $value['url'] ?? null;
			$result[$i] = [
				'id'           => (integer)$value['id'],
				'title'        => $value['title'],
				'category_url' => self::$urlSite . "/{$urlTag}/{$url}",
			];
			$i++;
		}

		return $result;
	}

	/**
	 * Создает массив ссылок
	 *
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

	/**
	 * Возвращает ошибку 404
	 *
	 * @return array
	 */
	public function api404()
	{
		return [
			'message'=>'Страница не найдена',
			'code'=>404,
		];
	}
}