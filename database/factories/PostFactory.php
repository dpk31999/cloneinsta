<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,4),
        'caption' => $faker->text,
        'image' => $faker->image('public/storage',640,480, null, false),
    ];
});
