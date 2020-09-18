<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('edo_civil');
            $table->smallInteger('genero');
            $table->date('fecha_nac');
            $table->date('fecha_ing');
            $table->smallInteger('cargo');
            $table->smallInteger('especialidad');
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
        Schema::dropIfExists('empleados');
    }
}
