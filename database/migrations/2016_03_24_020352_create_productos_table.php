<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique('pk_producto');
            $table->string('codigo', 10)->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->integer('idcategoria')->unsigned();
            $table->integer('stock');
            $table->double('precio_costo',10,3);
            $table->double('ganancia',10,3);
            $table->double('descuento',10,3);
            $table->double('precio_venta',10,3);
            $table->boolean('activo');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idcategoria')->references('id')->on('catalogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producto');
    }
}
