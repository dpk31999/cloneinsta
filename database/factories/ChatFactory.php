<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MessageGroup;
use Faker\Generator as Faker;

$factory->define(MessageGroup::class, function (Faker $faker) {

    return [
        'admin_id' => rand(3, 5),
        'message' => $faker->sentence,
        'is_read' => '0'
    ];
});
