<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Punchline;
use Faker\Generator as Faker;

$factory->define(Punchline::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(5),
        'is_validated' => 1,
        'artist_id' => $faker->numberBetween(1, 10),
        'title_id' => $faker->numberBetween(1, 10),
    ];
});
