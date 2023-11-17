<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposubmatsTable extends Migration{
    public function up(){
        Schema::create('gruposubmats', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('gruposubmat_material', function (Blueprint $table) {
            $table->bigInteger('gruposubmat_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->foreign('gruposubmat_id')->references('id')->on('gruposubmats');
            $table->foreign('material_id')->references('id')->on('materias');
            $table->unique(['gruposubmat_id', 'material_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('gruposubmat_material');
        Schema::dropIfExists('gruposubmats');
    }
}