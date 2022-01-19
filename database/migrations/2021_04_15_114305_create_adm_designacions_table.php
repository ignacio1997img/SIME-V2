<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmDesignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_designacions', function (Blueprint $table) {
            $table->id();
            $table->date('inicio');
            $table->date('fin');
            $table->date('fins')->nullable();
            $table->string('nombre',100); 
            $table->string('documento',300); 
            $table->string('observacion',300)->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('funcionario_id'); 
            $table->timestamps();

            $table->foreign('funcionario_id')->references('id')->on('adm_funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_designacions');
    }
}
