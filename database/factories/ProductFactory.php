<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
//$factory->define(App\User::class, function (Faker $faker)
use App\models\product;
$factory->define(product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address'=>$faker->address,
        'price'=>mt_rand(7000,170000),
        'depart'=>$faker->randomElement(['Foods' , 'Computers' , 'Books']),
        'quantity'=>mt_rand(0 , 100),
        'avilable'=>$faker->boolean,
    ];
});
