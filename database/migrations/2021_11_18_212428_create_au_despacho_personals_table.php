<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_personals', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');     
            $table->string('nombre');         
            // $table->unsignedBigInteger('segundo_id')->nullable();   
            // $table->boolean('estado')->default(true);         
            $table->boolean('estado');       
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
        Schema::dropIfExists('au_despacho_personals');
    }
}
