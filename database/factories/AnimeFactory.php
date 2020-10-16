<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace Database\Factories;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 8), true);
        $txt = $this->faker->realText(rand(1000, 4000));
        $arrRating = ['none', 'G', 'PG', 'PG-13', 'R-17', 'R+',];
        $arrTip = ['tv', 'movie', 'ova', 'ona', 'special', 'music'];
        $arrReleased = ['released', 'ongoing'];
        $data = $this->faker->date('Y-m-d');

        $data = [
            'user_id'       => rand(1, 11),
            'title'         => $title,
            'japanese'      => $title,
            'english'       => $title,
            'romaji'        => $title,
            'aired_season'  => date('Y', strtotime($data)),
            /*'date_of_birth' => $this->faker->dateTimeBetween('-10 year', 'now'),*/
            'delivery_time' => $this->faker->time('H:i'),
            'tv_canal'      => $this->faker->company,
            'count_series'  => random_int(1, 30),
            'duration'      => random_int(10, 150),
            'aired_on'      => $data,
            'released_on'   => $this->faker->dateTimeBetween('now', '+10 months'),
            'description'   => substr($txt, 0, 140),
            'metatitle'     => substr($title, 0, 140),
            'keywords'      => 'test, test1, test2',
            'released'      => $arrReleased[array_rand($arrReleased)],
            'tip'           => $arrTip[array_rand($arrTip)],
            'country_id'    => 198,
            'url'           => Str::slug($title),
            'content'       => $txt,

            'created_at' => $this->faker->dateTimeBetween('-2 months', '-1 days'),
        ];

        return $data;
    }
}
