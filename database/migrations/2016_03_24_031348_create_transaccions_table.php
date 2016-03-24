<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique('pk_transaccion');
            $table->integer('idcliente')->unsigned();
            $table->integer('idtipo')->unsigned();
            $table->date('fecha');
            $table->time('hora');
            $table->double('monto',10,2);
            $table->double('interes',10,2);
            $table->double('total',10,2);
            $table->integer('idestado')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idcliente')->references('id')->on('cliente');
            $table->foreign('idtipo')->references('id')->on('catalogo');
            $table->foreign('idestado')->references('id')->on('catalogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaccion');
    }
}
