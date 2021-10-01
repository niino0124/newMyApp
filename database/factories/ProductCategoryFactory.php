<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->text(100),
        'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 week'), // 追加
    ];
});
