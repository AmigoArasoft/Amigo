<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemasTable extends Migration{
    public function up(){
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 180)->unique;
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('tema_subtema', function (Blueprint $table) {
            $table->bigInteger('tema_id')->unsigned();
            $table->bigInteger('subtema_id')->unsigned();
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->foreign('subtema_id')->references('id')->on('parametros');
            $table->unique(['tema_id', 'subtema_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('tema_subtema');
        Schema::dropIfExists('temas');
    }
}