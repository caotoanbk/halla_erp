<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'SectionName' => $faker->word(3),
        'SectionInformation' => $faker->catchPhrase,
        'SectionStatus' => $faker->word(3),
        'team_id' => function () {
            return factory(App\Team::class)->create()->id;
        }
    ];
});
