<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CatalogoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        //$this->call(ProductoTableSeeder::class);
        //$this->call(ClienteTableSeeder::class);
        //$this->call(TransaccionTableSeeder::class);
        //$this->call(TransaccionDetalleTableSeeder::class);
        //$this->call(VentaDetalleTableSeeder::class);

        Model::reguard();
    }
}
