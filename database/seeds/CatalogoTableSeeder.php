<?php

use Illuminate\Database\Seeder;

class CatalogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Catalogo::class)->create([
        		'idtable'=> 0,
        		'iditem'=> 0,
        		'codigo'=> 'MAE',
        		'nombre'=> 'MAESTRO',
        		'descripcion'=> 'MAESTRO DE TABLAS',
        		'activo'=> TRUE
        	]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 0,
                'iditem'=> 1,
                'codigo'=> 'ROL',
                'nombre'=> 'ROL USUARIO',
                'descripcion'=> 'ROL DE USUARIO',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 0,
                'iditem'=> 2,
                'codigo'=> 'CAT',
                'nombre'=> 'CATEGORIA PRODUCTO',
                'descripcion'=> 'CATEGORIA DE LOS PRODUCTOS',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 0,
                'iditem'=> 3,
                'codigo'=> 'TITRA',
                'nombre'=> 'TIPO TRANSACCION',
                'descripcion'=> 'TIPO DE TRANSACCION A REALIZAR',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 0,
                'iditem'=> 4,
                'codigo'=> 'ESTA',
                'nombre'=> 'ESTADO',
                'descripcion'=> 'TIPO DE ESTADOS DE UNA ENTIDAD',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 1,
                'iditem'=> 1,
                'codigo'=> 'admin',
                'nombre'=> 'admin',
                'descripcion'=> 'Administrador del sistema',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 1,
                'iditem'=> 2,
                'codigo'=> 'vend',
                'nombre'=> 'vendedor',
                'descripcion'=> 'vendedor',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 2,
                'iditem'=> 1,
                'codigo'=> 'cat1',
                'nombre'=> 'cat1',
                'descripcion'=> 'categoria 1',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 2,
                'iditem'=> 2,
                'codigo'=> 'cat2',
                'nombre'=> 'cat2',
                'descripcion'=> 'categoria 2',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 3,
                'iditem'=> 1,
                'codigo'=> 'Prestamo',
                'nombre'=> 'Prestamo',
                'descripcion'=> 'Prestamo',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 3,
                'iditem'=> 2,
                'codigo'=> 'Venta',
                'nombre'=> 'Venta',
                'descripcion'=> 'Venta',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 4,
                'iditem'=> 1,
                'codigo'=> 'Pagado',
                'nombre'=> 'Pagado',
                'descripcion'=> 'Estado 1',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 4,
                'iditem'=> 2,
                'codigo'=> 'Debe',
                'nombre'=> 'Debe',
                'descripcion'=> 'Estado 2',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 3,
                'iditem'=> 3,
                'codigo'=> 'Ahorro',
                'nombre'=> 'Ahorro',
                'descripcion'=> 'Ahorro',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 4,
                'iditem'=> 3,
                'codigo'=> 'Abierto',
                'nombre'=> 'Abierto',
                'descripcion'=> 'Estado 1',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 4,
                'iditem'=> 4,
                'codigo'=> 'Cerrado',
                'nombre'=> 'Cerrado',
                'descripcion'=> 'Estado 2',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 3,
                'iditem'=> 4,
                'codigo'=> 'Pago',
                'nombre'=> 'Pago',
                'descripcion'=> 'Pago',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 0,
                'iditem'=> 5,
                'codigo'=> 'LUGAR',
                'nombre'=> 'LUGAR',
                'descripcion'=> 'LUGAR DONDE SE REALIZAN LAS VENTAS',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 5,
                'iditem'=> 1,
                'codigo'=> 'Juliaca',
                'nombre'=> 'Juliaca',
                'descripcion'=> 'Juliaca',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 5,
                'iditem'=> 2,
                'codigo'=> 'Arequipa',
                'nombre'=> 'Arequipa',
                'descripcion'=> 'Arequipa',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 5,
                'iditem'=> 3,
                'codigo'=> 'Huanuco',
                'nombre'=> 'Huanuco',
                'descripcion'=> 'Huanuco',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 5,
                'iditem'=> 4,
                'codigo'=> 'Pucallpa',
                'nombre'=> 'Pucallpa',
                'descripcion'=> 'Pucallpa',
                'activo'=> TRUE
            ]);
        factory(App\Catalogo::class)->create([
                'idtable'=> 5,
                'iditem'=> 5,
                'codigo'=> 'Huancayo',
                'nombre'=> 'Huancayo',
                'descripcion'=> 'Huancayo',
                'activo'=> TRUE
            ]);
    }
}
