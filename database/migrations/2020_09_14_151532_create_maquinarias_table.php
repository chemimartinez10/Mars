<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descripcion');
            $table->integer('anno');
            $table->decimal('peso');
            $table->timestamps();
            
            $table->integer('id_color')->unsigned();
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
        Schema::dropIfExists('maquinarias');
    }
}
