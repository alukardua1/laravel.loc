<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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
                'title' => 'Администратор',
            ],
            [
                'title' => 'Модератор',
            ],
            [
                'title' => 'Пользователь',
            ],
        ];

        DB::table('groups')->insert($data);
    }
}
