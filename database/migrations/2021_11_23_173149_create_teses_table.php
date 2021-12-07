<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('orientador');
            $table->string('titulacao_orientador');
            $table->string('coorientador');
            $table->string('titulacao_coorientador');
            $table->string('programa');

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
        Schema::dropIfExists('teses');
    }
}
