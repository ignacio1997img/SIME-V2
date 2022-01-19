<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_rubros', function (Blueprint $table) {
            $table->id();            
            $table->string('descripcion',100);
            $table->unsignedBigInteger('subgrupo_id');
            $table->timestamps();


            $table->foreign('subgrupo_id')->references('id')->on('adm_sub_grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_rubros');
    }
}
