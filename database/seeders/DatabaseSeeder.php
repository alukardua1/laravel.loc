<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

namespace Database\Seeders;

use App\Models\Anime;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(UsersSeeder::class);
        User::factory()->count(10)->create();
        $this->call(CategorySeeder::class);
        Anime::factory()->count(100)->create();
        //factory(Anime::class, 100)->create();
        $this->call(AnimeCategorySeeder::class);
    }
}
