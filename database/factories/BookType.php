<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\BookType::class, function (Faker $faker) {
    echo $faker->name;
    return [
        //
    ];
});
