<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'customer_id' => $faker->unique()->customer_id,
        'first_name' => $faker->first_name,
        'middle_name' => $faker->middle_name,
        'last_name' => $faker->last_name,
        'username' => $faker->username,
        'date_of_birth_or_age' => $faker->date_of_birth_or_age,
        'gender' => $faker->gender,
        'marital_status' => $faker->marital_status,
        'telephone' => $faker->telephone,
        'residence' => $faker->city,
        'avatar' => $faker->file(),
        'email' => $faker->email,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
