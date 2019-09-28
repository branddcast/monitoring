<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'jcastillo.brandon@gmail.com',
            'password' => bcrypt('brandito'),
            'rol' => 1
        ]);
    }
}
