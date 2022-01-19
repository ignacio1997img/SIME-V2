<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarrioContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrio_contactos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barrio_id'); 
            $table->unsignedBigInteger('contacto_id'); 
            $table->string('observacion',500)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('barrio_id')->references('id')->on('au_barrios');
            $table->foreign('contacto_id')->references('id')->on('au_contactos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_barrio_contactos');
    }
}
