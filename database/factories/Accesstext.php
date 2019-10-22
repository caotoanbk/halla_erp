<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Accesstext;
use Faker\Generator as Faker;

$factory->define(Accesstext::class, function (Faker $faker) {
    return [
        'AccesstextName' => $faker->title,
        'AccesstextInformation' => $faker->word(5),
        'AccesstextStatus' => $faker->word(3)
    ];
});
