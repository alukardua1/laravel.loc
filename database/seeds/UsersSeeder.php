<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                'login'             => 'admin',
                'name'              => '',
                'group_id'          => '1',
                'email'             => 'prizrack30@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('12345678'),
                'remember_token'    => Str::random(10),
            ],
        ];

        DB::table('users')->insert($data);
        factory(User::class, 10)->create();
    }
}
