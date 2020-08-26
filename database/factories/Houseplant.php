<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Houseplant;
use Faker\Generator as Faker;

$factory->define(Houseplant::class, function (Faker $faker) {
    return [
        "nickname" => $faker->name,
        "common_name" => $faker->name,
        "latin_name" => $faker->name,
        "birthday" => $faker->date,
        "soil" => $faker->sentence,
        "light" => $faker->sentence,
        "recommended_care" => $faker->text
    ];
});
