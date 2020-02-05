<?php

use Illuminate\Database\Seeder;

class AnimeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $categories = [];

        for ($i = 1; $i <= 300; $i++) {

            //$parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'anime_id' => random_int(1, 100),
                'category_id'   => random_int(1, 10),
            ];
        }

        DB::table('anime_category')->insert($categories);
    }
}
