<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use App\Member;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'member_id' => function() {
            return factory(Member::class)->create()->id;
        },
        'product_id' => function() {
            return factory(Product::class)->create()->id;
        },
        'evaluation' => $faker->numberBetween(1,5),
        'comment' => $faker->text(500),
        'created_at' => $faker->dateTimeThisYear,
    ];
});
