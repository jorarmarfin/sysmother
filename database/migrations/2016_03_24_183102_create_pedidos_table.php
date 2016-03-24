<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique('pk_pedido');
            $table->integer('idtransaccion')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->integer('cantidad');
            $table->double('total',10,2);
            $table->date('fecha');
            $table->time('hora');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idtransaccion')->references('id')->on('transaccion');
            $table->foreign('idproducto')->references('id')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedido');
    }
}
