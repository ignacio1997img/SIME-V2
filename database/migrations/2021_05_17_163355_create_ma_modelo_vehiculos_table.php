<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaModeloVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_modelo_vehiculos', function (Blueprint $table) {
            $table->id();            
            $table->string('descripcion',200);
            $table->unsignedBigInteger('marca_id')->unsigned();
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('ma_marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ma_modelo_vehiculos');
    }
}
