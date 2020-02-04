<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AnimePost;
use Faker\Generator as Faker;

//use App\Helpers\FunctionsHelpers;

$factory->define(AnimePost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $arrRating = ['none', 'G', 'PG', 'PG-13', 'R-17', 'R+',];
    $arrTip = ['tv', 'movie', 'ova', 'ona', 'special', 'music'];
    $arrReleased = ['released', 'ongoing'];
    $array = explode(' ', $txt);
    $maxKeywordCount = 10;

    $data = [
        'user_id'     => rand(1, 11),
        'title'       => $title,
        'description' => substr($txt, 0, 140),
        'metatitle'   => substr($title, 0, 140),
        'keywords'    => 'test, test1, test2',
        'country_id'  => 198,
        'url'         => Str::slug($title),
        'content'     => $txt,

        'created_at' => $faker->dateTimeBetween('-2 months', '-1 days'),
    ];

    return $data;
});
