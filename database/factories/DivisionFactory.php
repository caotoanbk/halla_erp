<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Division;
use Faker\Generator as Faker;

$factory->define(Division::class, function (Faker $faker) {
    return [
        'DivisionName' => $faker->company,
        'DivisionInfo' => $faker->catchPhrase,
        'DivisionStatus' => $faker->word(3),
        'company_id' => function () {
            return factory(App\Company::class)->create()->id;
        }
    ];
});
