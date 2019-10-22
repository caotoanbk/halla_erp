<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Part;
use Faker\Generator as Faker;

$factory->define(Part::class, function (Faker $faker) {
    return [
        'PartName' => $faker->word(3),
        'PartInformation' => $faker->catchPhrase,
        'PartStatus' => $faker->word(3),
        'team_id' => function () {
            return factory(App\Team::class)->create()->id;
        }
    ];
});
