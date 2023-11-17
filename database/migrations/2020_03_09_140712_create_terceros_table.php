<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTercerosTable extends Migration{
    public function up(){
        Schema::create('terceros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('persona_id')->unsigned();
            $table->bigInteger('comprador_id')->nullable()->unsigned();
            $table->bigInteger('documento_id')->unsigned();
            $table->string('documento', 20);
            $table->bigInteger('frente_id')->unsigned()->nullable()->unique();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->boolean('operador')->default(0);
            $table->boolean('transporte')->default(0);
            $table->string('rucom', 15)->nullable();
            $table->string('firma')->nullable();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('parametros');
            $table->foreign('documento_id')->references('id')->on('parametros');
            $table->foreign('comprador_id')->references('id')->on('parametros');
            $table->foreign('frente_id')->references('id')->on('parametros');
            $table->unique(['documento_id', 'documento']);
        });
        Schema::create('tercero_contacto', function (Blueprint $table) {
            $table->bigInteger('tercero_id')->unsigned();
            $table->bigInteger('contacto_id')->unsigned();
            $table->bigInteger('funcion_id')->unsigned();
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('contacto_id')->references('id')->on('terceros');
            $table->foreign('funcion_id')->references('id')->on('parametros');
            $table->unique(['tercero_id', 'contacto_id']);
        });
        Schema::create('tercero_material', function (Blueprint $table) {
            $table->bigInteger('tercero_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->Integer('tarifa')->unsigned();
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->unique(['tercero_id', 'material_id']);
        });
        Schema::create('tercero_transporte', function (Blueprint $table) {
            $table->bigInteger('tercero_id')->unsigned();
            $table->bigInteger('transporte_id')->unsigned();
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('transporte_id')->references('id')->on('terceros');
            $table->unique(['tercero_id', 'transporte_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('tercero_id')->references('id')->on('terceros');
        });
    }

    public function down(){
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_tercero_id_foreign');
        });
        Schema::dropIfExists('tercero_transporte');
        Schema::dropIfExists('tercero_material');
        Schema::dropIfExists('tercero_contacto');
        Schema::dropIfExists('terceros');
    }
}