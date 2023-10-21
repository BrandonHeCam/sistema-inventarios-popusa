<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Existencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencias', function (Blueprint $table) {
            $table->id();
            $table->string('lugar')->nullable();
            $table->string('cve_prod')->nullable();
            $table->string('existencia')->nullable();
            $table->string('costo')->nullable();
            $table->string('desc_prod')->nullable();
            $table->string('cse_prod')->nullable();
            $table->string('cve_tial')->nullable();
            $table->string('codbar')->nullable();
            $table->string('uni_med')->nullable();
            $table->string('des_lug')->nullable();
            $table->string('des_tial')->nullable();
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
        Schema::dropIfExists('existencias');
    }
}
