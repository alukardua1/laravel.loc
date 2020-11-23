<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'       => 'OVA',
                'url'        => 'ova',
                'full_name'  => 'Original Video Animation',
                'short_name' => 'ОВА'
            ],
            [
                'name'       => 'Movie',
                'url'        => 'movie',
                'full_name'  => 'Полнометражный фильм',
                'short_name' => 'Фильм'
            ],
            [
                'name'       => 'TV',
                'url'        => 'tv',
                'full_name'  => 'Телевизионная версия',
                'short_name' => 'ТВ'
            ],
            [
                'name'       => 'ONA',
                'url'        => 'ona',
                'full_name'  => 'Original net animation',
                'short_name' => 'Веб'
            ],
            [
                'name'       => 'Music',
                'url'        => 'music',
                'full_name'  => 'Музыкальное видео',
                'short_name' => 'Клип'
            ],
            [
                'name'       => 'Special',
                'url'        => 'special',
                'full_name'  => 'Специальные выпускы',
                'short_name' => 'Спешл'
            ]
        ];

        DB::table('kinds')->insert($data);
    }
}
