<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarridoPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrido_personals', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');     
            $table->string('nombre');         
            $table->boolean('estado')->default(true);         
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
        Schema::dropIfExists('au_barrido_personals');
    }
}
