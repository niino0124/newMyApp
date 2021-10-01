<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Product;
use App\Member;
use App\ProductCategory;
use App\ProductSubcategory;



$factory->define(Product::class, function (Faker $faker) {
    return [
        'member_id' => factory(Member::class),
        'product_category_id' => factory(ProductCategory::class),
        'product_subcategory_id' => factory(ProductSubcategory::class),
        'name' => $faker->text(10),
        'image_1' => $faker->randomElement(['0','1','2']),
        'image_2' => $faker->randomElement(['0','1','2']),
        'image_3' => $faker->randomElement(['0','1','2']),
        'image_4' => $faker->randomElement(['0','1','2']),
        'product_content' => $faker->text(20),

    ];
});
