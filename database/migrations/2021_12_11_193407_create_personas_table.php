<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('persona_id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('edad');
            $table->string('sexo');
            $table->string('celular')->nullable();
            $table->string('tipo_persona'); //niño o adulto
            $table->integer('persona_estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
