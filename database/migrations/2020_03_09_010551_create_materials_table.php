<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration{
    public function up(){
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 180)->unique;
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('material_submaterial', function (Blueprint $table) {
            $table->bigInteger('material_id')->unsigned();
            $table->bigInteger('submaterial_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('submaterial_id')->references('id')->on('parametros');
            $table->unique(['material_id', 'submaterial_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('material_submaterial');
        Schema::dropIfExists('materials');
    }
}