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

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    $title = $faker->unique()->company;
    return [
        'title' => $title,
        'content' => $faker->realText(400),
        'slug' => strtolower(str_replace(',', '', str_replace(' ', '-', trim($title)))),
    ];
});
