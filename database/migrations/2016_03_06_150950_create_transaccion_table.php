<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionTable extends Migration
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
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->decimal('monto', 10,2)->nullable();
            $table->decimal('interes', 10,2)->nullable();
            $table->decimal('total', 10,2)->nullable();
            $table->boolean('idestado');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idcliente')->references('id')->on('cliente');
            $table->foreign('idtipo')->references('id')->on('catalogo');
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
