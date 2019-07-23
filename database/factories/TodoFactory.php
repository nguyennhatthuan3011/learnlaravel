<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'user_id'=> $faker->numberBetween(1, App\User::count()),
        'title' => Str::random(100),
        'complete' => $faker->boolean(),
    ];
});
