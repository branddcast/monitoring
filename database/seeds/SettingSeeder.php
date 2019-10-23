<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('settings')->insert([
            'nombre_titular' => $faker->name,
            'apellidos_titular' => $faker->lastname,
            'seccion' => 'Caja Fuerte',
            'periodo' => '15',
            'usuario' => 1
        ]);
    }
}
