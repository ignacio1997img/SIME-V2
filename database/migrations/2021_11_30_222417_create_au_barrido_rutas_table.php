<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarridoRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrido_rutas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',250);
            $table->string('descripcion',500);
            $table->string('inicio',250);
            $table->string('fin',250);
            // $table->string('distancia',200);
            $table->string('urlimg',1000)->nullable();

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
        Schema::dropIfExists('au_barrido_rutas');
    }
}
