<?php

use Illuminate\Database\Seeder;

class TransaccionDetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TransaccionDetalle::class,20)->create();
    }
}
