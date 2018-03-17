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

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text(),
        //  'post_id' => factory(App\Models\Post::class)->create()->id,
        //  'user_id' => factory(App\Models\User::class)->create()->id
    ];
});
