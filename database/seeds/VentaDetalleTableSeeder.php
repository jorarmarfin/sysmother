<?php

use Illuminate\Database\Seeder;

class VentaDetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\VentaDetalle::class,30)->create();
    }
}
