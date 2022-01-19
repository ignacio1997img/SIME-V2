<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarridoPersonalReemplazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrido_personal_reemplazos', function (Blueprint $table) {
            $table->id();
            $table->string('reemplazando',500);            
            $table->string('reemplazado', 500);      
            $table->unsignedBigInteger('despachodetalle_id');            
            $table->timestamps();

            $table->foreign('despachodetalle_id')->references('id')->on('au_barrido_despacho_detalles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_barrido_personal_reemplazos');
    }
}
