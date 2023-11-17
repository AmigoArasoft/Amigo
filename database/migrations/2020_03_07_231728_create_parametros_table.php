<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosTable extends Migration{
    public function up(){
        Schema::create('parametros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 180)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('parametros');
    }
}