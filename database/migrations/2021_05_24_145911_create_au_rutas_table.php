<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_rutas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 300);
            $table->string('turno', 50);
            $table->string('urlimg', 500);
            $table->unsignedBigInteger('tipo_id'); 
            $table->unsignedBigInteger('zona_id'); 
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('au_tipo_servicios');
            $table->foreign('zona_id')->references('id')->on('au_zonas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_rutas');
    }
}
