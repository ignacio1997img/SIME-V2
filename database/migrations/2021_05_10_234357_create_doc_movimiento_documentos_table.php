<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocMovimientoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_movimiento_documentos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('documento_id');
            $table->unsignedBigInteger('cargo_id'); 
            $table->string('de',300); //nombre de quien lo envia
            $table->string('de_fuera',300)->nullable(); // cuando es una externa

            $table->string('dirigido',300);

            $table->string('nota',800);
  
            $table->dateTime('fechahraenvio');
            $table->dateTime('fechahrarecibido')->nullable();
            $table->dateTime('fechahraposenvio')->nullable();
            
            $table->dateTime('fechaatrazo')->nullable();

            $table->boolean('entrada')->default(true);
            $table->boolean('pendiente')->default(true);
            $table->boolean('despachada')->default(false);
            $table->boolean('recibido')->default(false);

            $table->string('estado');

            $table->integer('cabecera');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();


            $table->foreign('documento_id')->references('id')->on('doc_documentacions');
            $table->foreign('cargo_id')->references('id')->on('adm_cargos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_movimiento_documentos');
    }
}
