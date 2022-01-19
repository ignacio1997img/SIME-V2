<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_funcionarios', function (Blueprint $table) {
            $table->id();   
            $table->date('fechaingreso');            
            // $table->string('observacion',150)->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('persona_id'); 
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('adm_personas');
        });
    }


    
    public function down()
    {
        Schema::dropIfExists('adm_funcionarios');
    }
}
