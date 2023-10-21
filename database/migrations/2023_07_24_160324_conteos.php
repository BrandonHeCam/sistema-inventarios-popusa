<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conteos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conteos', function (Blueprint $table) {
            $table->id();
            $table->string('codbar')->nullable();
            $table->string('cve_prod')->nullable();
            $table->string('conteo1');
            $table->string('conteo2')->nullable();
            $table->foreignId('id_usuario')->references('id')->on('usuariosconteos');
            $table->foreignId('id_producto')->references('id')->on('productos');

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
        Schema::dropIfExists('conteos');
    }
}
