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
        'idrole' => '7',
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
 * Tabla Producto
 */
$factory->define(App\Producto::class, function ($faker) {
    return [
        'codigo' => $faker->bothify('Cod##??'),
        'nombre' => $faker->name,
        'descripcion' => $faker->sentence(6,true),
        'idcategoria' => $faker->numberBetween(8,9),
        'stock' => $faker->randomDigit,
        'precio_costo' => $faker->randomFloat(2,1,100),
        'ganancia' => $faker->randomFloat(2,1,100),
        'descuento' => $faker->randomFloat(2,1,100),
        'precio_venta' => $faker->randomFloat(2,1,100),
        'activo' => $faker->boolean,
        'remember_token' => str_random(10),

    ];
});

/*
 * Tabla Cliente
 */
$factory->define(App\Cliente::class, function ($faker) {
    return [
        'nombres' => $faker->name,
        'dni' => $faker->numerify('########'),
        'telefono' => $faker->phoneNumber,
        'celular' => $faker->phoneNumber,
        'email' => $faker->email,
        'direccion' => $faker->address,
        'tienda' => $faker->streetName,
        'foto' => $faker->imageUrl(100, 100,'people'),
        'remember_token' => str_random(10),
    ];
});

/*
 * Tabla Transaccion
 */
$factory->define(App\Transaccion::class, function ($faker) {
    return [
        'idcliente' => $faker->numberBetween(1,20),
        'idtipo' => $faker->randomElement($array = array (10,11,14,17)),
        'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'hora' => $faker->time($format = 'H:i:s', $max = 'now'),
        'monto' => $faker->numberBetween($min = 500, $max = 9000),
        'interes' => $faker->numberBetween($min = 2, $max = 9),
        'idestado' => $faker->randomElement($array = array (12,13,15,16)),
        'remember_token' => str_random(10),
    ];
});

/*
 * Tabla Transaccion Detalle
 */
$factory->define(App\TransaccionDetalle::class, function ($faker) {
    return [
        'idtransaccion' => $faker->numberBetween(1,30),
        'entrada' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100),
        'salida' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100),
        'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'hora' => $faker->time($format = 'H:i:s', $max = 'now'),
        'remember_token' => str_random(10),
    ];
});

/*
 * Tabla Venta Detalle
 */
$factory->define(App\VentaDetalle::class, function ($faker) {
    return [
        'idtransaccion' => $faker->numberBetween(1,30),
        'idproducto' => $faker->numberBetween(1,20),
        'cantidad' => $faker->randomDigitNotNull(),
        'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'hora' => $faker->time($format = 'H:i:s', $max = 'now'),
        'remember_token' => str_random(10),
    ];
});