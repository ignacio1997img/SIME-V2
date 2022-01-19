<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_areas', function (Blueprint $table) {
            $table->id();            
            $table->string('descripcion',100);
            $table->unsignedBigInteger('empresa_id')->unsigned();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('adm_empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_areas');
    }
}
