<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Product;
use App\Member;
use App\ProductCategory;
use App\ProductSubcategory;



$factory->define(Product::class, function (Faker $faker) {
    return [
        // 選ぶというより、新たに作られてしまっている
        'member_id' => function() {
            $member_ids = Member::select('id')->get()->toArray();
            $member_id = array_rand($member_ids,1);
            return $member_id;
    },
        'product_category_id' =>  function() {
                $product_category_ids = ProductCategory::select('id')->get()->toArray();
                $product_category_id = array_rand($product_category_ids,1);
                return $product_category_id;
        },
        // 'product_category_id' =>  function() {
        //     return factory(ProductCategory::class)->create()->id;
        // },
        'product_subcategory_id' => 10,
        // 'product_subcategory_id' => function() {
        //     return factory(ProductSubcategory::class)->create()->id;
        // },
        'name' => $faker->text(10),
        'image_1' => $faker->randomElement(['0','1','2']),
        'image_2' => $faker->randomElement(['0','1','2']),
        'image_3' => $faker->randomElement(['0','1','2']),
        'image_4' => $faker->randomElement(['0','1','2']),
        'product_content' => $faker->text(20),

    ];
});
