<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDespachoPartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_despacho_partes', function (Blueprint $table) {
            $table->id();

            $table->date('fecha');
            $table->string('parte',50)->nullable();
            $table->string('turno', 50)->nullable();
            $table->boolean('cotidiano')->default(true);
            $table->boolean('combustible');
            $table->boolean('estado')->default(true);
            $table->string('obsparte')->nullable();
            $table->string('chofer',300);
            $table->integer('registradorparte_id')->unsigned()->nullable();

            //detalle de movimiento
            // $table->decimal('totalhrs', 3,2)->nullable();
            // $table->decimal('totalkm', 3)->nullable();

            // //detalle de viaje
            // $table->decimal('totalkg', 3,2)->nullable();

            // //datos del supervisor emaut
            // $table->integer('supervisoremaut_id')->unsigned()->nullable();
            // $table->decimal('cobertura', 4,2)->nullable();
            // $table->string('obssupervisor')->nullable();
            // $table->string('urlimg')->nullable();



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
        Schema::dropIfExists('au_despacho_partes');
    }
}
