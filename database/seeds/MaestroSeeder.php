<?php

use Illuminate\Database\Seeder;

class MaestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Maestro::class,10)->create();
    }
}
