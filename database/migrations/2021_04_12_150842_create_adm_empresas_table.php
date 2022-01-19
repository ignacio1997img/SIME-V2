<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_empresas', function (Blueprint $table) {
            $table->id();                 
            $table->string('nit',50);
            $table->string('razonsocial',300);
            $table->string('sigla',50)->nullable();
            $table->string('direccion',200)->nullable();
            $table->string('telempresa',50)->nullable();
            $table->string('emailempresa')->nullable()->unique();
            $table->string('contacto',100)->nullable();
            $table->string('telefonocontacto',20)->nullable();
            $table->string('emailcontacto')->nullable();
            $table->boolean('personal')->default(false);
            $table->boolean('vehiculo')->default(false);
            $table->boolean('activa')->default(true);
            $table->unsignedBigInteger('rubroempresa_id');  

            $table->timestamps();

            $table->foreign('rubroempresa_id')->references('id')->on('adm_rubros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_empresas');
    }
}
