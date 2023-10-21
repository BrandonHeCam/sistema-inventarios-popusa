<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_zona')->references('id')->on('zonas');
            $table->string('folio',255);
            $table->enum('status',['ACTIVE','LOCKED'])->default('ACTIVE');
            $table->date('fechaInicial');
            $table->date('fechaFinal');
            $table->string('observaciones', 255);
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
        Schema::dropIfExists('inventarios');
    }
}
