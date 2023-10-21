<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Zonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->id();
            $table->string('clave',255)->unique();
            $table->string('descripcion',255);
            $table->foreignId('id_almacen')->references('id')->on('almacenes');
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
        Schema::dropIfExists('zonas');
    }
}
