<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produnids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produnids', function (Blueprint $table) {
            $table->id();
            $table->string('cve_prod')->nullable();
            $table->string('unidad')->nullable();
            $table->string('factor')->nullable();
            $table->string('conver')->nullable();
            $table->string('codbar')->nullable();
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
        Schema::dropIfExists('produnids');
    }
}
