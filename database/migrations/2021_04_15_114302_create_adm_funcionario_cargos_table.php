<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmFuncionarioCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_funcionario_cargos', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('funcionario_id'); 
            $table->unsignedBigInteger('cargo_id'); 
            $table->date('inicio');    
            $table->string('detalle',500)->nullable();   
            $table->date('fin')->nullable();    
            $table->string('motivo',500)->nullable(); 
            $table->string('observacion',500)->nullable();   
            $table->integer('activo')->default(true);            
            $table->timestamps();
            $table->foreign('funcionario_id')->references('id')->on('adm_funcionarios');
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
        Schema::dropIfExists('adm_funcionario_cargos');
    }
}
