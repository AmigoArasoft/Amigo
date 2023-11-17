<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerceroTarifaTable extends Migration {
    public function up() {
        Schema::create('tercero_tarifa', function (Blueprint $table) {
            $table->bigInteger('tercero_id')->unsigned();
            $table->bigInteger('tarifa_id')->unsigned();
            $table->double('tarifa', 8, 2)->unsigned();
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('tarifa_id')->references('id')->on('tarifas');
            $table->unique(['tercero_id', 'tarifa_id']);
        });
    }

    public function down() {
        Schema::dropIfExists('tercero_tarifa');
    }
}
