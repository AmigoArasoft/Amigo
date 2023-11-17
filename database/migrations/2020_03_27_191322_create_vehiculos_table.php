<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration{
    public function up(){
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tercero_id')->unsigned()->nullable();
            $table->bigInteger('conductor_id')->unsigned()->nullable();
            $table->string('placa', 6)->unique();
            $table->float('volumen', 5, 2)->unsigned();
            $table->string('marca', 20)->nullable();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('conductor_id')->references('id')->on('terceros');
        });
    }

    public function down(){
        Schema::dropIfExists('vehiculos');
    }
}