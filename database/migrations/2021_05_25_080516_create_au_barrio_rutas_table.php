<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarrioRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrio_rutas', function (Blueprint $table) {
            $table->id();        
            $table->unsignedBigInteger('ruta_id'); 
            $table->unsignedBigInteger('barrio_id'); 
            $table->timestamps();
            
            $table->foreign('ruta_id')->references('id')->on('au_rutas');
            $table->foreign('barrio_id')->references('id')->on('au_barrios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_barrio_rutas');
    }
}
