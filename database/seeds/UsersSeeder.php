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
            'email' => 'admin@demo.com',
            'password' => bcrypt('admin'),
            'rol' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
