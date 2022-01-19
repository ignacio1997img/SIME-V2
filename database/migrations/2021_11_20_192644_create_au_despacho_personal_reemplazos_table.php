<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoPersonalReemplazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_personal_reemplazos', function (Blueprint $table) {
            $table->id();
            $table->string('reemplazando',500);            
            $table->string('reemplazado', 500);      
            $table->unsignedBigInteger('despachoparte_id');            
            $table->timestamps();

            // $table->foreign('primero_id')->references('id')->on('adm_funcionarios');
            // $table->foreign('segundo_id')->references('id')->on('adm_funcionarios');
            $table->foreign('despachoparte_id')->references('id')->on('au_despacho_partes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_despacho_personal_reemplazos');
    }
}
