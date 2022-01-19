<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoParteEstimadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_parte_estimados', function (Blueprint $table) {
            $table->id();
            $table->biginteger('pesobascula');
            $table->unsignedBigInteger('despachoparte_id'); 
            $table->timestamps();

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
        Schema::dropIfExists('au_despacho_parte_estimados');
    }
}
