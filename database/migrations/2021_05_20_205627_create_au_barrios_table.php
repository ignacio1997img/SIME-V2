<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuBarriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_barrios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 300);
            $table->unsignedBigInteger('distrito_id'); 
            $table->timestamps();

            $table->foreign('distrito_id')->references('id')->on('au_distritos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_barrios');
    }
}
