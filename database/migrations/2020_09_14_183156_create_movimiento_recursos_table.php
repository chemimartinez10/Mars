<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_recursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento'); 
            $table->date('fecha');
            $table->decimal('cantidad');
            $table->text('observacion');
            $table->timestamps();


            $table->BigInteger('id_operacion')->unsigned();
            $table->BigInteger('id_movimiento')->unsigned();
            $table->foreign('id_movimiento')->references('id')->on('movimientos')
            ->onDelete('cascade')
            ->onUpdate('cascade');        
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
        Schema::dropIfExists('movimiento_recursos');
    }
}
