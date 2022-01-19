<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHyGlicemiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hy_glicemias', function (Blueprint $table) {
            $table->id();
            $table->integer('valor');
            $table->string('realizado',300);
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
        Schema::dropIfExists('hy_glicemias');
    }
}
