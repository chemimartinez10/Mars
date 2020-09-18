<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial')->unique();
            $table->integer('anno');
            $table->BigInteger('id_recurso')->unsigned();
            $table->timestamps();
            
            $table->integer('id_color')->unsigned();


            $table->foreign('id_recurso')->references('id')->on('recursos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            // $table->foreign('id_marca')->references('id')->on('elementos_configuraciones')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
            // $table->foreign('id_modelo')->references('id')->on('elementos_configuraciones')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
            // $table->foreign('id_color')->references('id')->on('elementos_configuraciones')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
            // $table->foreign('id_tipo')->references('id')->on('elementos_configuraciones')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
            // $table->foreign('id_estado')->references('id')->on('elementos_configuraciones')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
