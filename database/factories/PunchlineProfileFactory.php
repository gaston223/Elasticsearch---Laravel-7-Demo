<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\PunchlineProfile;
use Faker\Generator as Faker;

$factory->define(PunchlineProfile::class, function (Faker $faker) {
    return [
        'punchline_id' => $faker->numberBetween(1, 20),
        'user_id' => $faker->numberBetween(1, 20),
        'position' => 1
    ];
});
