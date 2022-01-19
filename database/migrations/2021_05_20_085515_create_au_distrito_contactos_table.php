<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuDistritoContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_distrito_contactos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distrito_id'); 
            $table->unsignedBigInteger('contacto_id'); 
            $table->string('observacion',500)->nullable();
            $table->boolean('activo')->default(true);

            $table->timestamps();

            $table->foreign('distrito_id')->references('id')->on('au_distritos');
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
        Schema::dropIfExists('au_distrito_contactos');
    }
}
