<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Repositories\Interfaces\ParseVideoCDNRepositoryInterface;
use App\Traits\FunctionsTrait;

/**
 * Class ParseVideoCDNRepository
 *
 * @package App\Repositories
 */
class ParseVideoCDNRepository implements ParseVideoCDNRepositoryInterface
{
	use FunctionsTrait;

	protected static $CDNVideo;
	private static   $worldArtId = 1;

	/**
	 * @param $api
	 *
	 * @return mixed
	 */
	public function parseCurl($api)
	{
		self::$CDNVideo = self::getCurl(
			config('appSecondConfig.CDNUrl').config(
				'appSecondConfig.CDNToken'
			).'&worldart_animation_id='.$api
		);
		self::$CDNVideo = json_decode(self::$CDNVideo, true);

		return self::$CDNVideo;
	}

	/**
	 *
	 */
	public function parseData()
	{
		// TODO: Implement parseData() method.
	}
}