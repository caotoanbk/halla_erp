<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subpage;
use Faker\Generator as Faker;

$factory->define(Subpage::class, function (Faker $faker) {
    return [
        'SubpageName' => $faker->word(3),
        'SubpageInformation' => $faker->word(5),
        'SubpageStatus' => $faker->word(3)
    ];
});
