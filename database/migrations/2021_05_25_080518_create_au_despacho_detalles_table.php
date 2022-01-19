<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('activo')->default(1);;// 1= creado     2= derivado   3=finalizado
            $table->unsignedBigInteger('despacho_id'); 
            $table->unsignedBigInteger('ruta_id'); 
            $table->string('vehiculo_id',50); 
            $table->timestamps();

            $table->foreign('despacho_id')->references('id')->on('au_despachos');
            $table->foreign('ruta_id')->references('id')->on('au_rutas');
            $table->foreign('vehiculo_id')->references('interno')->on('ma_vehiculos');
        });
    }

    /**ç
     * Reverse the migrations.
 
     */
    public function down()
    {
        Schema::dropIfExists('au_despacho_detalles');
    }
}
