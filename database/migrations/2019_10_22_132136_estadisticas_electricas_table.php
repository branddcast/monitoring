<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadisticasElectricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadisticas_electricas', function($table) {
            $table->bigIncrements('id');
            $table->decimal('voltaje', 3,2);
            $table->decimal('corriente', 3,2);
            $table->decimal('potencia', 3, 2);
            $table->decimal('costo', 5,2);
            $table->dateTime('encendido');
            $table->dateTime('apagado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
