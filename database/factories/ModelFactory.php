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

use Faker\Generator;
use App\Repository\Rectangles;
use App\Repository\Markers;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    
    return [
      'name' => $faker->name,
      'email' => $faker->email,
      'password' => $password ?: $password = bcrypt('123456'),
      'remember_token' => str_random(10),
    ];
});

$factory->define(Markers::class, function (Generator $faker) {
    return [
      'lat' => $faker->numberBetween(20951200,21157152)/1000000,
      'lng' => $faker->numberBetween(105456528,105919273)/1000000,
      'speed' => $faker->numberBetween(1,60),
      'position' => $faker->numberBetween(1,1288),
      'record_user' => $faker->numberBetween(1,10),
      'record_time' => $faker->dateTimeBetween('-30 mins','+0 mins'),
    ];
});

