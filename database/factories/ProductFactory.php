<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'audit_id' => rand(1,31),

        'name' => $faker->name,

        'status' => $faker->boolean,

        'slug' => $faker->text(15)
    ];
});
