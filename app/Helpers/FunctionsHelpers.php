<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Helpers;


use DateTimeZone;
use IntlDateFormatter;

trait FunctionsHelpers
{
    /**
     * Сокращенная версия массива с типами
     *
     * @var array $arrTip
     */
    public static $arrTip = [
        'tv'      => 'ТВ',
        'movie'   => 'Фильм',
        'ova'     => 'OVA',
        'ona'     => 'ONA',
        'special' => 'Спешл',
        'music'   => 'Клип'
    ];

    /**
     * Расширенная версия массива с типами
     *
     * @var array $arrFullTip
     */
    public static $arrFullTip = [
        'tv'      => 'Телевизионная версия',
        'movie'   => 'Полнометражный фильм',
        'ova'     => 'Original Video Anime',
        'ona'     => 'Original Network Anime',
        'special' => 'Специальный выпуск',
        'music'   => 'Музыкальное видео'
    ];

    /**
     * Массив данных для вывода рейтинга видео
     *
     * @var array $arrRating
     */
    public static $arrRating = [
        ''      => '<span class="float-xl-right">Рейтинг не указан</span>',
        'none'  => '<span class="float-xl-right">Рейтинг не указан</span>',
        'G'     => '<span class="float-xl-right">"G" - Нет возрастных ограничений</span>',
        'PG'    => '<span class="float-xl-right">"PG" - Рекомендуется присутствие родителей</span>',
        'PG-13' => '<span class="float-xl-right">"PG-13" - Детям до 13 лет просмотр не желателен</span>',
        'R-17'  => '<span class="float-xl-right">"R" - Лицам до 17 лет обязательно присутствие взрослого</span>',
        'R+'    => '<span class="float-xl-right">"R+" - Лицам до 17 лет просмотр запрещен</span>',
    ];

    /**
     * Массив данных для вывода рейтинга видео в админке
     *
     * @var array $arrRatings
     */
    public static $arrRatings = [
        'none'  => 'Рейтинг не указан',
        'G'     => '"G" - Нет возрастных ограничений',
        'PG'    => '"PG" - Рекомендуется присутствие родителей',
        'PG-13' => '"PG-13" - Детям до 13 лет просмотр не желателен',
        'R-17'  => '"R" - Лицам до 17 лет обязательно присутствие взрослого',
        'R+'    => '"R+" - Лицам до 17 лет просмотр запрещен',
    ];

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
        12 => 'зима - '
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
        23 => '<span style="color: #990000; ">[ночной сеанс]</span>'
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
}
