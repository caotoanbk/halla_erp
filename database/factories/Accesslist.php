<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Accesslist;
use Faker\Generator as Faker;

$factory->define(Accesslist::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'subpage_id' => function () {
            return factory(App\Subpage::class)->create()->id;
        },
        'accesstext_id' => function () {
            return factory(App\Accesstext::class)->create()->id;
        }
    ];
});
