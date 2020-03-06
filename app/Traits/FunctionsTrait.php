<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Traits;


use Cache;
use Carbon\Carbon;
use DateTimeZone;
use IntlDateFormatter;

/**
 * Trait FunctionsTrait
 *
 * @package App\Helpers
 */
trait FunctionsTrait
{
	/**
	 * Приставка для сезона
	 *
	 * @var array $arrMsg
	 */
	public static $arrMsg = [
		1  => 'зима - ',
		3  => 'весна - ',
		6  => 'лето - ',
		9  => 'осень - ',
		12 => 'зима - ',
	];

	/**
	 * Показывает время сеанса
	 *
	 * @var array $arrDay
	 */
	public static $arrDay = [
		8  => '<span style="color: green; ">[утренний сеанс]</span>',
		12 => '<span style="color: #146867; ">[дневной сеанс]</span>',
		17 => '<span style="color: blue; ">[вечерний сеанс]</span>',
		23 => '<span style="color: #990000; ">[ночной сеанс]</span>',
	];

	/**
	 * Возвращает временные зоны
	 *
	 * @return array getTimeZone()
	 */
	public static function getTimeZone(): array
	{
		$timeZone = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
		$tz = [];
		$i = 0;
		foreach ($timeZone as $key => $value) {
			$formatter = new IntlDateFormatter(
				'ru_RU',
				IntlDateFormatter::FULL,
				IntlDateFormatter::FULL,
				$value,
				IntlDateFormatter::GREGORIAN,
				'(ZZZZ) VVV'
			);
			$tz[$i++] = $formatter->format(0);
		}

		return $tz;
	}

	/**
	 * Формирует поле сезон выхода
	 *
	 * @param  string  $aired_on
	 *
	 * @var string     $seasons
	 * @return string
	 */
	public static function airedSeason($aired_on): string
	{
		$seasons = '';
		foreach (self::$arrMsg as $key => $value) {
			if (Carbon::parse($aired_on)->format('m') >= $key) {
				if (Carbon::parse($aired_on)->format('m') == 12) {
					$year = Carbon::parse($aired_on)->format('Y') + 1;
					$seasons = $value.$year;
				} else {
					$seasons = $value.Carbon::parse($aired_on)->format('Y');
				}
			}
		}
		return $seasons;
	}

	/**
	 * Формирует поле описания времени суток
	 *
	 * @param  string  $time
	 *
	 * @var string     $day
	 * @return mixed|string
	 */
	public static function deliveryTime($time)
	{
		$day = '';
		foreach (self::$arrDay as $key => $value) {
			if ($time >= $key) {
				$day = $value;
			}
		}
		return $day;
	}

	/**
	 * Проверка наличия кэша страницы на сайте
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return mixed
	 */
	public static function getCache($key, $value)
	{
		if (Cache::has($key)) {
			return Cache::get($key);
		}

		return self::setCache($key, $value);
	}

	/**
	 * Внесение дополнительного в пост
	 *
	 * @param $anime
	 *
	 * @return mixed
	 */
	public static function currentRefactoring($anime)
	{
		$anime->day = self::deliveryTime($anime->delivery_time);
		$anime->seasons = self::airedSeason($anime->aired_on);

		return $anime;
	}

	/**
	 * Обрабатывает поля для глобальных кустом
	 *
	 * @param  array   $arr
	 * @param  string  $keys
	 *
	 * @return array
	 */
	public static function customArr($arr, $keys): array
	{
		$result = [];
		foreach ($arr as $key => $value) {
			$result[] = $value[$keys];
		}
		$result = array_count_values($result);

		krsort($result);

		return $result;
	}

	public static function parseUrl($url)
	{
		$returnUrl = [];
		$uri = explode('-', $url);
		$stringUrl = preg_split("/[0-9]+-/", $url);

		$returnUrl['uri'] = $uri;
		$returnUrl['stringUrl'] = $stringUrl;

		return $returnUrl;
	}
}
