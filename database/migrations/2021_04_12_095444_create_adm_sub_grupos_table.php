<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmSubGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_sub_grupos', function (Blueprint $table) {
            $table->id();            
            $table->string('descripcion',100);
            $table->unsignedBigInteger('grupo_id')->unsigned();
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('adm_grupo_empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_sub_grupos');
    }
}
