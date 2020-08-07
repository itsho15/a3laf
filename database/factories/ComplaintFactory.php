<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Complaint;
use Faker\Generator as Faker;

$factory->define(Complaint::class, function (Faker $faker) {

    return [
        'content' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
