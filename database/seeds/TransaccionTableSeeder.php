<?php

use Illuminate\Database\Seeder;

class TransaccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Transaccion::class,20)->create();
    }
}
