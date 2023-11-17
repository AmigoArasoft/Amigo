<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration{
    public function up(){
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('fecha_nombre', 100);
            $table->bigInteger('factura_id')->unsigned()->nullable();
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->bigInteger('conductor_id')->unsigned()->nullable();
            $table->bigInteger('operador_id')->unsigned();
            $table->bigInteger('transporte_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->bigInteger('submaterial_id')->unsigned();
            $table->bigInteger('frente_id')->unsigned();
            $table->float('volumen', 5, 2)->unsigned();
            $table->integer('valor')->unsigned();
            $table->float('total', 10, 2)->unsigned();
            $table->boolean('eliminado')->default(0);
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('conductor_id')->references('id')->on('terceros');
            $table->foreign('operador_id')->references('id')->on('terceros');
            $table->foreign('transporte_id')->references('id')->on('terceros');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('submaterial_id')->references('id')->on('parametros');
            $table->foreign('frente_id')->references('id')->on('parametros');
        });
    }

    public function down(){
        Schema::dropIfExists('viajes');
    }
}