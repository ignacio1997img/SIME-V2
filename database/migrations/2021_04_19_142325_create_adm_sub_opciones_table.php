<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmSubOpcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_sub_opciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',200); 
            $table->unsignedBigInteger('opciones_id'); 
            $table->timestamps();

            $table->foreign('opciones_id')->references('id')->on('adm_opciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_sub_opciones');
    }
}
