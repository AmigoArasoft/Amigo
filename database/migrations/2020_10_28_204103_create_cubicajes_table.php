<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCubicajesTable extends Migration{
    public function up(){
        Schema::create('cubicajes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('fecha_nombre', 100);
            $table->bigInteger('tercero_id')->unsigned();
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->float('volumen_ancho')->unsigned();
            $table->float('volumen_largo')->unsigned();
            $table->float('volumen_alto')->unsigned();
            $table->float('gato_mayor')->unsigned();
            $table->float('gato_menor')->unsigned();
            $table->float('gato_alto')->unsigned();
            $table->float('gato_ancho')->unsigned();
            $table->float('borde_base')->unsigned();
            $table->float('borde_alto')->unsigned();
            $table->float('borde_largo')->unsigned();
            $table->float('volumen')->unsigned();
            $table->string('titular', 50);
            $table->string('operador', 50);
            $table->string('transportador', 50);
            $table->string('observacion')->nullable();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
        });
    }

    public function down(){
        Schema::dropIfExists('cubicajes');
    }
}