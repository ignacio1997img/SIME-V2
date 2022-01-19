<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuFrecuenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_frecuencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zona_id'); 
            $table->unsignedBigInteger('dia_id'); 

            $table->timestamps();

            $table->foreign('zona_id')->references('id')->on('au_zonas');
            $table->foreign('dia_id')->references('id')->on('au_dias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_frecuencias');
    }
}
