<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'idrole' => '4',
        'remember_token' => str_random(10),
    ];
});
/*
 * Tabla catalogo
 */
$factory->define(App\Catalogo::class, function ($faker) {
    return [
        'idtable' => $faker->randomDigitNotNull,
        'iditem' => $faker->randomDigitNotNull,
        'codigo' => $faker->name,
        'nombre' => $faker->name,
        'descripcion' => $faker->boolean,
        'remember_token' => str_random(10),

    ];
});
/*
 * Tabla Maestro
 */
$factory->define(App\Maestro::class, function ($faker) {
    return [
        'idmaestro' => $faker->randomDigitNotNull,
        'descripcion' => $faker->name,
        'remember_token' => str_random(10),

    ];
});
/*
 * Tabla Detalle
 */
$factory->define(App\Detalle::class, function ($faker) {
    return [
        'nombre' => $faker->name,
        'remember_token' => str_random(10),

    ];
});