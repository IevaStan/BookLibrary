<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 0; $i < 20; $i++) {
        //     Author::create([
        //         'name' => fake()->name,
        //         'surname' => fake()->name,
        //         'birthdate' => fake()->date(),
        //         'country' => fake()->country
        //     ]);
        // }
        Author::factory(10)->create();
    }
}
