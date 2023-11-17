<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupomatsTable extends Migration{
    public function up(){
        Schema::create('grupomats', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->boolean('activo')->default(1);
            $table->bigInteger('user_create_id')->unsigned();
            $table->bigInteger('user_update_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('grupomat_gruposubmat', function (Blueprint $table) {
            $table->bigInteger('grupomat_id')->unsigned();
            $table->bigInteger('gruposubmat_id')->unsigned();
            $table->foreign('grupomat_id')->references('id')->on('grupomats');
            $table->foreign('gruposubmat_id')->references('id')->on('gruposubmats');
            $table->unique(['grupomat_id', 'gruposubmat_id']);
        });
    }

    public function down(){
        Schema::dropIfExists('grupomat_gruposubmat');
        Schema::dropIfExists('grupomats');
    }
}