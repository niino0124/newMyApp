<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductSubcategory;
use Faker\Generator as Faker;

$factory->define(ProductSubcategory::class, function (Faker $faker) {
    return [
        'product_category_id'   => $faker->realText(100),
        'name' => $faker->realText(3000),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime('2021-09-29 22:37:17'),
    ];
});
