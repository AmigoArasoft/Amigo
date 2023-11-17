<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration{
    public function up(){
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('material_especificacion', function (Blueprint $table) {
            $table->bigInteger('material_id')->unsigned();
            $table->bigInteger('especificacion_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materias');
            $table->foreign('especificacion_id')->references('id')->on('especificacions');
            $table->unique(['material_id', 'especificacion_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('material_especificacion');
        Schema::dropIfExists('materias');
    }
}