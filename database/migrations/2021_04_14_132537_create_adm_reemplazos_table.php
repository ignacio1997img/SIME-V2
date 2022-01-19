<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmReemplazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_reemplazos', function (Blueprint $table) {
            $table->id();
            $table->date('inicio');
            $table->date('fin')->nullable();
            $table->date('fins')->nullable();
            $table->string('documento',500)->nullable(); 
            $table->string('observacion',500)->nullable();
            $table->string('a',600);
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('funcar_id');
            $table->unsignedBigInteger('baja_id')->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable(); 
            $table->timestamps();

            $table->foreign('funcar_id')->references('id')->on('adm_funcionario_cargos');
            $table->foreign('baja_id')->references('id')->on('adm_baja_funs');
            $table->foreign('cargo_id')->references('id')->on('adm_cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_reemplazos');
    }
}
