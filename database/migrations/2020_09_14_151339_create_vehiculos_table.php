<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placa')->unique();
            $table->integer('anno');
            $table->integer('pasajeros');
            $table->integer('km');
            $table->timestamps();
            
            $table->integer('id_color')->unsigned();
            $table->integer('id_tipoVehiculo')->unsigned();
            $table->integer('id_combustible')->unsigned();
            $table->integer('id_modelo')->unsigned();

            $table->BigInteger('id_recurso')->unsigned();
            $table->foreign('id_recurso')->references('id')->on('recursos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
