<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'TeamName' => $faker->word(3),
        'TeamInformation' => $faker->catchPhrase,
        'TeamStatus' => $faker->word(3),
        'division_id' => function () {
            return factory(App\Division::class)->create()->id;
        }
    ];
});
