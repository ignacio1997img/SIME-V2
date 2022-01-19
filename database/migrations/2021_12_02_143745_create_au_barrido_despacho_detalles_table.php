<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarridoDespachoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrido_despacho_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('activo')->default(1);;// 1= creado     2= derivado   3=finalizado
            $table->string('turno', 50);
            $table->unsignedBigInteger('despacho_id'); 
            $table->unsignedBigInteger('ruta_id'); 
            
            $table->timestamps();

            $table->foreign('despacho_id')->references('id')->on('au_barrido_despachos');
            $table->foreign('ruta_id')->references('id')->on('au_barrido_rutas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_barrido_despacho_detalles');
    }
}
