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
		8  => '<span class="green-text">[утренний сеанс]</span>',
		12 => '<span class="cyan-text">[дневной сеанс]</span>',
		17 => '<span class="blue-text">[вечерний сеанс]</span>',
		23 => '<span class="deep-orange-text">[ночной сеанс]</span>',
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
	 * Внесение дополнительного в пост
	 *
	 * @param  \App\Models\Anime  $anime
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

	/**
	 * Получение id и slug из url
	 *
	 * @param $url
	 *
	 * @return array
	 */
	public static function parseUrl($url): array
	{
		$pattern = "/[0-9]+-/";
		$returnUrl = [];
		$uri = explode('-', $url);
		$stringUrl = preg_split($pattern, $url);

		$returnUrl['uri'] = $uri;
		$returnUrl['stringUrl'] = $stringUrl;

		return $returnUrl;
	}

	/**
	 * Загружает временные зоны и страны
	 *
	 * @param  \App\Models\Country  $countryRaw
	 *
	 * @return array
	 */
	public static function loadCountryTimeZone($countryRaw): array
	{
		$countryArray = [];
		foreach ($countryRaw as $key => $value) {
			$countryArray[$value['id']] = $value['title'];
		}
		$timeZone = self::getTimeZone();

		return ['countryArray' => $countryArray, 'timeZone' => $timeZone];
	}

	public static function getCurl($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FAILONERROR, 1);
		curl_setopt($curl, CURLOPT_USERAGENT,
					"Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
		$data = curl_exec($curl);
		curl_close($curl);

		return $data;
	}
}
