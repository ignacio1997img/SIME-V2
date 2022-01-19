<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoPesoTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_peso_totals', function (Blueprint $table) {
            $table->id();
            $table->biginteger('peso')->default(0);
            $table->biginteger('viaje')->default(0);
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
        Schema::dropIfExists('au_despacho_peso_totals');
    }
}
