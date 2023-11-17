<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecificacionsTable extends Migration{
    public function up(){
        Schema::create('especificacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('especificacion_parametro', function (Blueprint $table) {
            $table->bigInteger('especificacion_id')->unsigned();
            $table->bigInteger('parametro_id')->unsigned();
            $table->foreign('especificacion_id')->references('id')->on('especificacions');
            $table->foreign('parametro_id')->references('id')->on('parametros');
            $table->unique(['especificacion_id', 'parametro_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('especificacion_parametro');
        Schema::dropIfExists('especificacions');
    }
}