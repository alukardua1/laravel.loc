<?php

use App\Models\AnimePost;
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
        $this->call(ChanalsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategorySeeder::class);
        factory(AnimePost::class, 100)->create();
        $this->call(AnimeCategorySeeder::class);
    }
}
