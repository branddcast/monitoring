<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
        	['Nombre' => 'Administrador']
        );

        DB::table('roles')->insert(
        	['Nombre' => 'Lector']
        );
    }
}
