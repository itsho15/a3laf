<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\test;
use Faker\Generator as Faker;

$factory->define(test::class, function (Faker $faker) {

    return [
        'id' => $faker->word
    ];
});
