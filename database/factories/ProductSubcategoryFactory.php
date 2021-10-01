<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductSubcategory;
use Faker\Generator as Faker;

$factory->define(ProductSubcategory::class, function (Faker $faker) {
    return [
        'product_category_id' => function() {
            return factory(ProductCategory::class)->create()->id;
        },
        'name' => $faker->realText(20),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime('2021-09-29 22:37:17'),
    ];
});
