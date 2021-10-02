<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Product;
use App\Member;
use App\ProductCategory;
use App\ProductSubcategory;



$factory->define(Product::class, function (Faker $faker) {
    // メンバ
    $member_ids = Member::all()->pluck('id')->toArray();
    $id = array_rand($member_ids, 1);
    $member_id = $member_ids[$id];
    // カテゴリ
    $ids = ProductCategory::all()->pluck('id')->toArray();
    $id = array_rand($ids, 1);
    $category_id = $ids[$id];
    // サブカテゴリ
    $sub_ids = ProductSubcategory::where('product_category_id',$category_id)->pluck('id')->toArray();
    $id = array_rand($sub_ids, 1);
    $sub_id = $sub_ids[$id];

    // 画像
    $arrayPath = glob('public/storage/*'); // <-- 取得したいパスを指定
    srand();
    $i = mt_rand( 0, count( $arrayPath ) - 1 );
    $i_2 = mt_rand( 0, count( $arrayPath ) - 1 );
    $i_3 = mt_rand( 0, count( $arrayPath ) - 1 );
    $i_4 = mt_rand( 0, count( $arrayPath ) - 1 );

    $image_1 = basename($arrayPath[$i]);
    $image_2 = basename($arrayPath[$i_2]);
    $image_3 = basename($arrayPath[$i_3]);
    $image_4 = basename($arrayPath[$i_4]);


    return [
        'member_id' => $member_id,
        'product_category_id' => $category_id,
        'product_subcategory_id' => $sub_id,
        'name' => $faker->word,
        'image_1' => $image_1,
        'image_2' => $image_2,
        'image_3' => $image_3,
        'image_4' => $image_4,
        'product_content' => $faker->text(20),
    ];
});
