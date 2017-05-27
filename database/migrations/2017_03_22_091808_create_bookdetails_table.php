<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Identificacion');
            $table->string('Nombre');
            $table->integer('pais_id')->unsigned()->index();
            $table->foreign('pais_id')->references('id')->on('country');
            $table->string('Sexo');
            $table->date('FechaEntrada');
            $table->date('FechaSalida');
            $table->integer('Noches');
            $table->string('Motivo');
            $table->integer('book_id')->unsigned()->index();
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookdetails');
    }
}
