<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\File;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'size' => $faker->word,
        'file' => $faker->word,
        'path' => $faker->word,
        'full_file' => $faker->word,
        'mime_type' => $faker->word,
        'file_type' => $faker->word,
        'relation_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
