<?php


namespace App\Helpers;


use DateTimeZone;
use IntlDateFormatter;

trait FunctionsHelpers
{
    /**
     * Массив с типами
     *
     * @var array
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
     * Массив данных для вывода рейтинга видео
     *
     * @var array
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
     * @var array
     */
    public static $arrMsg = [
        1  => 'зима - ',
        3  => 'весна - ',
        6  => 'лето - ',
        9  => 'осень - ',
        12 => 'зима - '
    ];
    /**
     * @var array
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
     * @return array
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
     * @param       $arrayWords
     * @param  int  $repeatWordCount
     * @param  int  $minWordLength
     *
     * @return array
     */
//    public function keywords($arrayWords, $repeatWordCount = 2, $minWordLength = 3)
//    {
//        $tmpArr = [];
//        $resultArray = [];
//
//        foreach ($arrayWords as $val) {
//            if (strlen($val) >= $minWordLength) {
//                $val = mb_strtolower($val);
//                if (array_key_exists($val, $tmpArr)) {
//                    $tmpArr[$val]++;
//                } else {
//                    $tmpArr[$val] = 1;
//                }
//            }
//
//            if ($tmpArr[$val] >= $repeatWordCount) {
//                $resultArray[$val] = $tmpArr[$val];
//            }
//        }
//
//        arsort($resultArray);
//
//        return $resultArray;
//    }
}
