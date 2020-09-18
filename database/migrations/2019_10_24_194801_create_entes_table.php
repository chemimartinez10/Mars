<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_soc')->unique();
            $table->string('descripcion');
            $table->timestamps();
            
            $table->bigInteger('persona_id')->unsigned();
            
            $table->foreign('persona_id')->references('id')->on('personas')
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
        Schema::dropIfExists('entes');
    }
}
