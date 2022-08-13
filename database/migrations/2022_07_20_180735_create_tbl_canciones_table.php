<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_canciones', function (Blueprint $table) {
            $table->bigIncrements('id_cancion');
            $table->string('cancion_titulo');
            $table->unsignedBigInteger('id_tipo_cancion');
            $table->string('cancion_nota');
            $table->integer('cancion_numero_estrofas');
            $table->timestamps();

            $table->foreign('id_tipo_cancion')->references('id_tipo_cancion')->on('tbl_tipo_canciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_canciones');
    }
}
