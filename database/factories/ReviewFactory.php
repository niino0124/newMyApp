<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use App\Member;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
        // メンバ
        $member_ids = Member::all()->pluck('id')->toArray();
        $id = array_rand($member_ids, 1);
        $member_id = $member_ids[$id];
        // プロダクト
        $product_ids = Product::all()->pluck('id')->toArray();
        $id = array_rand($product_ids, 1);
        $product_id = $product_ids[$id];

    return [
        'member_id' => $member_id,
        'product_id' => $product_id,
        'evaluation' => $faker->numberBetween(1,5),
        'comment' => $faker->text(500),
        'created_at' => $faker->dateTimeThisYear,
    ];
});
