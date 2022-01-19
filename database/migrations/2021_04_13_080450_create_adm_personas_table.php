<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_personas', function (Blueprint $table) {
            $table->id();
            $table->string('ci',12);
            $table->string('expedido',5);          
            $table->string('nombre',70);
            $table->string('apellidopaterno',30);
            $table->string('apellidomaterno',30)->nullable();
            $table->string('apellidoesposo',30)->nullable();
            $table->string('sexo',10);
            $table->string('direccion',100)->nullable();
            $table->string('telefono',50)->nullable();
            $table->date('fechanacimiento')->nullable();
            $table->string('correo',200)->nullable();
            $table->boolean('activa')->default(true);
            $table->boolean('asignada')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_personas');
    }
}
