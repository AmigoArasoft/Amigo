<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration{
    public function up(){
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tema_id')->unsigned();
            $table->bigInteger('subtema_id')->unsigned()->nullable();
            $table->string('titulo', 150)->unique();
            $table->string('descripcion');
            $table->string('archivo');
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->foreign('subtema_id')->references('id')->on('parametros');
        });
    }

    public function down(){
        Schema::dropIfExists('documentos');
    }
}