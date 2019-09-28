<?php

use Illuminate\Database\Seeder;

class HashesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hashes')->insert([
        	'hash' => sha1('esta_es_la_huella_digital_generada_desde_el_sensor_y_encriptada')
        ]);
    }
}
