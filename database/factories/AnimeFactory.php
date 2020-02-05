<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Anime;
use Faker\Generator as Faker;

//use App\Helpers\FunctionsHelpers;

$factory->define(Anime::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $arrRating = ['none', 'G', 'PG', 'PG-13', 'R-17', 'R+',];
    $arrTip = ['tv', 'movie', 'ova', 'ona', 'special', 'music'];
    $arrReleased = ['released', 'ongoing'];
    $data = $faker->date('Y-m-d');

    $data = [
        'user_id'       => rand(1, 11),
        'title'         => $title,
        'japanese'      => $title,
        'english'       => $title,
        'romaji'        => $title,
        'aired_season'  => date('Y', strtotime($data)),
        'delivery_time' => $faker->time('H:i'),
        'tv_canal'      => $faker->company,
        'count_series'  => random_int(1, 30),
        'duration'      => random_int(10, 150),
        'aired_on'      => $data,
        'released_on'   => $faker->dateTimeBetween($data, '+10 months'),
        'description'   => substr($txt, 0, 140),
        'metatitle'     => substr($title, 0, 140),
        'keywords'      => 'test, test1, test2',
        'kind'          => $arrRating[array_rand($arrRating)],
        'released'      => $arrReleased[array_rand($arrReleased)],
        'tip'           => $arrTip[array_rand($arrTip)],
        'country_id'    => 198,
        'url'           => Str::slug($title),
        'content'       => $txt,

        'created_at' => $faker->dateTimeBetween('-2 months', '-1 days'),
    ];

    return $data;
});
