<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Member;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name_sei' => $faker->lastName,
        'name_mei' => $faker->firstName,
        'nickname' => $faker->firstKanaName,
        'gender' => $faker->randomElement(['1','2']),
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password(8),
        'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 week'),
    ];
});
