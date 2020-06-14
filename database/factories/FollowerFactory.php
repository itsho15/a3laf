<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Follower;
use Faker\Generator as Faker;

$factory->define(Follower::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'follower_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
