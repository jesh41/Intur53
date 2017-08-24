<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->integer('telefono');
            $table->integer('id_city')->unsigned()->index();
            $table->foreign('id_city')->references('id')->on('city');
            $table->integer('id_municipio')->unsigned()->index();
            $table->foreign('id_municipio')->references('id')->on('municipio');
            $table->integer('id_cathotel')->unsigned()->index();
            $table->foreign('id_cathotel')->references('id')->on('category');
            $table->integer('id_catactivity')->unsigned()->index();
            $table->foreign('id_catactivity')->references('id')->on('activity');
            $table->integer('id_user')->unsigned()->index();
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('hotel');
    }
}
