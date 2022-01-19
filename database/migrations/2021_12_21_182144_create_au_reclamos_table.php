<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuReclamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_reclamos', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('registrado',400);
            $table->string('descripcion');
            $table->datetime('fechareclamo');
            $table->unsignedBigInteger('calle_id'); 
            $table->unsignedBigInteger('contacto_id'); 

            $table->string('atendido',400)->nullable();
            $table->datetime('fecharegistroatendido')->nullable();
            $table->datetime('fechaatendido')->nullable();
            $table->string('solucion', 600)->nullable();

            $table->integer('estado')->default(1);//1 no visto   2 retrazado  3 pendienete   4 realizado

            $table->timestamps();

            $table->foreign('contacto_id')->references('id')->on('au_contactos');
            $table->foreign('calle_id')->references('id')->on('au_calles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('au_reclamos');
    }
}
