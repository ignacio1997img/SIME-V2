<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombrecompleto', 150)->unique();
            $table->string('direccion', 500)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('referencia', 500)->nullable();            
            $table->boolean('distrito')->default(0);
            $table->boolean('barrio')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_contactos');
    }
}
