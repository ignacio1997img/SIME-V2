<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuParteMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_parte_movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fsalida');
            $table->time('hsalida');
            $table->date('fllegada');
            $table->time('hllegada');
            $table->integer('kmsalida');
            $table->integer('kmllegada');
            

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
        Schema::dropIfExists('au_parte_movimientos');
    }
}
