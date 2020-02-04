<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        for ($i = 0; $i <= 10; $i++) {
            $cName = 'Категория #'.$i;
            //$parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title' => $cName,
                'url'   => Str::slug($cName),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
