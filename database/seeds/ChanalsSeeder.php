<?php

use Illuminate\Database\Seeder;

class ChanalsSeeder extends Seeder
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
                'title' => 'Неуказан'
            ]
        ];

        DB::table('chanals')->insert($data);
    }
}
