<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_cargos', function (Blueprint $table) {
            $table->id();            
            $table->string('codigo',20);
            $table->string('nombre',100);
            $table->string('sigla',30);
            $table->boolean('activo')->default(true);
            $table->string('observacion',150)->nullable();     
            
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('tipocargo_id');
            $table->timestamps();
            
            $table->foreign('area_id')->references('id')->on('adm_areas');
            $table->foreign('tipocargo_id')->references('id')->on('adm_tipo_cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_cargos');
    }
}
