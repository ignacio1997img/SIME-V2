<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuReclamoAtenderUnidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_reclamo_atender_unidads', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo',400);
            $table->string('funcionario',400);
            $table->unsignedBigInteger('reclamo_id'); 

            $table->timestamps();

            $table->foreign('reclamo_id')->references('id')->on('au_reclamos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_reclamo_atender_unidads');
    }
}
