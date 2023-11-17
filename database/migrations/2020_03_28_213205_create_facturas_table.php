<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration{
    public function up(){
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tercero_id')->unsigned();
            $table->date('fecha');
            $table->string('fecha_nombre', 100);
            $table->date('desde');
            $table->string('desde_nombre', 100);
            $table->date('hasta');
            $table->string('hasta_nombre', 100);
            $table->float('valor', 12, 2)->unsigned();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
            $table->foreign('tercero_id')->references('id')->on('terceros');
        });
    }

    public function down(){
        Schema::dropIfExists('facturas');
    }
}