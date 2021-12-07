<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaEducacionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_educacionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
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
        Schema::dropIfExists('programa_educacionals');
    }
}
