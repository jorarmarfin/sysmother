<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique('pk_cliente');
            $table->string('paterno',25)->nullable();
            $table->string('materno',25)->nullable();
            $table->string('nombres',50)->nullable();
            $table->string('dni',10)->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('celular',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('direccion',50)->nullable();
            $table->string('tienda',50)->nullable();
            $table->string('foto',15)->nullable();
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
        Schema::drop('cliente');
    }
}
