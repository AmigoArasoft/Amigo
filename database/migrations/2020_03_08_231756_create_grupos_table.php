<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration{
    public function up(){
        Schema::create('grupos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 180)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('grupo_parametro', function (Blueprint $table) {
            $table->bigInteger('grupo_id')->unsigned();
            $table->bigInteger('parametro_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('parametro_id')->references('id')->on('parametros');
            $table->unique(['grupo_id', 'parametro_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('grupo_parametro');
        Schema::dropIfExists('grupos');
    }
}