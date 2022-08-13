<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEstrofas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_estrofas', function (Blueprint $table) {
            $table->bigIncrements('id_estrofa');
            $table->unsignedBigInteger('id_cancion');
            $table->text('estrofa_contenido');
            $table->timestamps();

            $table->foreign('id_cancion')->references('id_cancion')->on('tbl_canciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_estrofas');
    }
}
