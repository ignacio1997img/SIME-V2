<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_vehiculos', function (Blueprint $table) {
            
            $table->string('interno',50)->unique()->primary();
            $table->string('propiedad',50);  
            $table->string('colorunidad',50);
            $table->string('placa',10)->nullable();
            $table->string('motor',50);
            $table->string('serieunidad',50)->nullable();
            $table->string('chasis',50)->nullable();
            $table->string('capacidadkg',10)->nullable();  
            $table->string('capacidadm3',10)->nullable();
            $table->string('pesovehiculo',10)->nullable();  
            $table->string('combustible',15)->nullable();
            $table->string('year',5)->nullable();               
            $table->date('fechacompra')->nullable();
            $table->decimal('montocompra',10,2)->nullable();   
            $table->string('estado',50);
            $table->unsignedBigInteger('tipo_id')->unsigned();
            $table->unsignedBigInteger('modelo_id')->unsigned();
            $table->unsignedBigInteger('empresa_id')->unsigned();
            
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('ma_tipo_vehiculos');
            $table->foreign('modelo_id')->references('id')->on('ma_modelo_vehiculos');
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
        Schema::dropIfExists('ma_vehiculos');
    }
}
