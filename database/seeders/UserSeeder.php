<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(1)->create(['email' => 'test1@gmail.com']);
        // User::factory(1)->create(['email' => 'test2@gmail.com', 'password'=> Hash::make('123456')]);

        for ($i = 0; $i < 30; $i++) {
            User::factory(1)->create(
                ['email' => 'testas' . $i . '@gmail.com', 'password' => Hash::make('testas' . $i)]
            );
        }
    }
}
