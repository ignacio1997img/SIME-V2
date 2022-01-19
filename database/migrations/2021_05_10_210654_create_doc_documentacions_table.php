<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocDocumentacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_documentacions', function (Blueprint $table) {
            $table->id();
            $table->boolean('interna')->default(true); //   1=interna, 2=externa
            $table->unsignedBigInteger('cargo_id'); 
            $table->boolean('tipo'); // para ver si es cargo o reemplazo
            $table->integer('estado');// 1= creado     2= derivado   3=finalizado
            $table->string('de',300); //nombre de quien lo envia
            $table->string('de_fuera',300)->nullable(); // cuando es una externa
            $table->dateTime('fechacrear'); //fecha cuando se crea el documento
            $table->dateTime('fechaenvio')->nullable(); //fecha despues cuando se crea y se guarda al momento de derivar o enviar el doc
            $table->string('sigla', 50); //sigla en la hoja de ruta
            $table->string('via',300)->nullable();
            $table->string('vb',300)->nullable();
            $table->string('referencia',800); //para la referencia de la creacion del documento
            $table->string('tipodocumento',300);
            $table->unsignedBigInteger('user_id'); // para llevar el seguimiento
            // $table->unsignedBigInteger('tipodocumento_id'); // para llevar el seguimiento
            
            $table->timestamps();

            $table->foreign('cargo_id')->references('id')->on('adm_cargos');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('tipodocumento_id')->references('id')->on('adm_tipo_documentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_documentacions');
    }
}
