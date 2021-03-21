<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Audit;
use Faker\Generator as Faker;

$factory->define(Audit::class, function (Faker $faker) {
    return [

        'table_name' => $faker->text(5),

        'row_code' => $faker->randomNumber(5),

        'operation_type_code' => $faker->text(5),

        'statement' => $faker->text(5),

        'user_id' => 1,
    ];
});
