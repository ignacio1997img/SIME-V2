<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuCallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_calles', function (Blueprint $table) {
            $table->id();
            $table->string('calle',300);
            $table->string('descripcion',600)->nullable();
            $table->unsignedBigInteger('barrio_id'); 
            $table->timestamps();

            $table->foreign('barrio_id')->references('id')->on('au_barrios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_calles');
    }
}
