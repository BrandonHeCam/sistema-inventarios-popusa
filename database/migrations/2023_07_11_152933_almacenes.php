<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Almacenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenes', function (Blueprint $table) {
            $table->id();
            $table->string('clave',255)->unique();
            $table->string('descripcion',255);
            $table->rememberToken();
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
        {
            Schema::dropIfExists('almacenes');
        }
    }
}
