<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Model\BookType\BookType::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'remark' => $faker->text(100),
        'sort' => $faker->numberBetween(1, 10),
        'pid' => $faker->numberBetween(11, 20),
        'create_time' => time(),
        'update_time' => time()
    ];
});
