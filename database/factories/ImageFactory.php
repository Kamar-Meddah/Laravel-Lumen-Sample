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

$factory->define(App\Models\Image::class, function (Faker\Generator $faker) {
    $title = $faker->unique()->word;
    return [
        'title' => $title,
        'path' => 'images/'.$title,
        //  'post_id' => factory(App\Models\Post::class)->create()->id

    ];
});
