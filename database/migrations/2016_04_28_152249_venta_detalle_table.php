<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VentaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_detalle', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique('pk_venta_detalle');
            $table->integer('idtransaccion')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->double('entrada',10,2);
            $table->double('salida',10,2);
            $table->date('fecha');
            $table->time('hora');
            $table->foreign('idtransaccion')->references('id')->on('transaccion');
            $table->foreign('idproducto')->references('id')->on('transaccion');
            $table->rememberToken();
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
        Schema::drop('venta_detalle');
    }
}
