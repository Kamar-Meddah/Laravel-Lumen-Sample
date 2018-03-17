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
    $title = $faker->unique()->firstName;
    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => password_hash('kamar',1)
    ];
});

$factory->defineAs(App\Models\User::class,'admin', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\Models\User::class);
    return array_merge($user,['role'=> 'admin']);
});
