<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_combustibles', function (Blueprint $table) {
            $table->id();
            $table->biginteger('factura')->nullable();
            $table->biginteger('orden')->nullable();
            $table->biginteger('boleta');
            $table->biginteger('contrato')->nullable();
            $table->double('litro');
            $table->double('bs');
            $table->unsignedBigInteger('despachodetalle_id');            
            $table->timestamps();
            $table->foreign('despachodetalle_id')->references('id')->on('au_despacho_detalles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_despacho_combustibles');
    }
}
