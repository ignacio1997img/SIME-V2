<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmBajaFunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_baja_funs', function (Blueprint $table) {
            $table->id();
            $table->date('inicio');
            $table->date('fin');
            $table->string('documento',500)->nullable(); 
            $table->string('observacion',500)->nullable();
            $table->string('tipo',50);
            $table->boolean('activo')->default(true);
            $table->boolean('ult')->default(true);
            $table->unsignedBigInteger('funcar_id'); 
            $table->timestamps();

            $table->foreign('funcar_id')->references('id')->on('adm_funcionario_cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_baja_funs');
    }
}
