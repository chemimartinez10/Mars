<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->decimal('cantidad');
            $table->text('observacion');
            $table->timestamps();
            
            $table->integer('id_marca')->unsigned();
            $table->integer('id_tipo')->unsigned();
            $table->integer('id_estado')->unsigned();
            
            
            // $table->foreign('id_marca')->references('id')->on('elementos_configuraciones')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
            // $table->foreign('id_tipo')->references('id')->on('elementos_configuraciones')
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
        Schema::dropIfExists('recursos');
    }
}
