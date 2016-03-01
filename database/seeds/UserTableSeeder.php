<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Luis Fernando',
            'email' => 'luis.mayta@gmail.com',
            'password' => '321654987',
            'idrole' => '3',

            ]);
        factory(App\User::class,10)->create();
    }
}
