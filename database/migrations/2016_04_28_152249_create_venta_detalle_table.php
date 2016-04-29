<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaDetalleTable extends Migration
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
            $table->integer('cantidad');
            $table->date('fecha');
            $table->time('hora');
            $table->foreign('idtransaccion')->references('id')->on('transaccion');
            $table->foreign('idproducto')->references('id')->on('producto');
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
