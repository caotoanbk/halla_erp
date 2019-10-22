<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'EmployeeName' => $faker->word(3),
        'EmployeeFirstName' => $faker->word(2),
        'EmployeeLastName' => $faker->word(2),
        'EmployeeInformation' => $faker->word(3),
        'EmployeeStatus' => $faker->word(2),
        'EmployeeEmail' => 'test@example.com',
        'EmployeeImage' => '24.jpg',
        'section_id' => function () {
            return factory(App\Section::class)->create()->id;
        }
    ];
});
