<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalavraChavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palavra_chaves', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('palavra');

            $table->unsignedBigInteger('documento_id');
            $table->foreign('documento_id')->references('id')->on('requisicao_documentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palavra_chaves');
    }
}
