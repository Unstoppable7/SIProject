<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
            'audit_id' => rand(1,31),

            'name' => $faker->name,

            'registry_number' => (string)$faker->randomNumber(), //nulleable

            'address' => $faker->address, //nulleable

            'latitud_number' => $faker->randomNumber(), //nulleable

            'longitude_number' => $faker->randomNumber(), //nulleable

            'mobile_number' => $faker->e164PhoneNumber, //nulleable

            'phone_number' => $faker->phoneNumber, //nulleable

            'email' => $faker->email, //nulleable

            'country_code' => $faker->randomNumber(), //nulleable

            'branch_status' => $faker->boolean,

            'active_status' => $faker->boolean,
    ];
});
