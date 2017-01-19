<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});

$factory->define(App\Models\Channel::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->word),
        'slug' => $faker->unique()->isbn10,
        'description' => $faker->sentence(6, true),
    ];
});
