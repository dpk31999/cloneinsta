<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    do {
        $from = rand(1, 4);
        $to = rand(1, 4);
        $is_read = rand(0, 1);
        $type = array("comment","post");
        $action = array("like","comment","replyCmt");
    } while ($from === $to);
    return [
        //
    ];
});
