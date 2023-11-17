<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifasTable extends Migration{
    public function up(){
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('tarifa_gruposubmat', function (Blueprint $table) {
            $table->bigInteger('tarifa_id')->unsigned();
            $table->bigInteger('gruposubmat_id')->unsigned();
            $table->foreign('tarifa_id')->references('id')->on('tarifas');
            $table->foreign('gruposubmat_id')->references('id')->on('gruposubmats');
            $table->unique(['tarifa_id', 'gruposubmat_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('tarifa_gruposubmat');
        Schema::dropIfExists('tarifas');
    }
}