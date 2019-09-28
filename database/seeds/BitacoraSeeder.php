<?php

use Illuminate\Database\Seeder;

use \Carbon\Carbon;

class BitacoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bitacora')->insert([
        	'proceso' => 'Inicio de Sesión',
        	'intentos' => '0',
        	'estado' => 'Sesión Permitida',
        	'created_at' => Carbon::now()
        ]);

        DB::table('bitacora')->insert([
        	'proceso' => 'Inicio de Sesión',
        	'intentos' => '3',
        	'estado' => 'Sesión Permitida',
        	'created_at' => Carbon::now()
        ]);

        DB::table('bitacora')->insert([
        	'proceso' => 'Inicio de Sesión',
        	'intentos' => '2',
        	'estado' => 'Sesión Permitida',
        	'created_at' => Carbon::now()
        ]);

        DB::table('bitacora')->insert([
        	'proceso' => 'Inicio de Sesión',
        	'intentos' => '0',
        	'estado' => 'Sesión Permitida',
        	'created_at' => Carbon::now()
        ]);
    }
}
