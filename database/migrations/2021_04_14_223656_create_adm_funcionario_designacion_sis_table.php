<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmFuncionarioDesignacionSisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_funcionario_designacion_sis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id'); 
            $table->unsignedBigInteger('designaciones_id'); 
            $table->timestamps();

            $table->foreign('funcionario_id')->references('id')->on('adm_funcionarios');
            $table->foreign('designaciones_id')->references('id')->on('adm_designacion_sistemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_funcionario_designacion_sis');
    }
}
