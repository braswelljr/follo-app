<?php

/** @var Factory $factory */

use App\Task;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'user_id' => $faker->user_id,
        'appointment' => $faker->appointment,
        'type' => $faker->type,
        'status' => $faker->status,
        'body' => $faker->body,
        'reminder' => $faker->dateTime(),
    ];
});
