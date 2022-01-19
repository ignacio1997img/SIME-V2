<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmTipoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_tipo_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adm_tipo_documentos');
    }
}
