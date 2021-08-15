<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'member_id' => 1,
                'product_category_id' => 2,
                'product_subcategory_id' => 6,
                'name' => '32vテレビ',
                'product_content' => '当該のテレビに関する説明',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 1,
                'product_category_id' => 1,
                'product_subcategory_id' => 5,
                'name' => 'HUE照明',
                'product_content' => '室内を自由に彩る間接照明',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 10,
                'name' => 'オートマティックレンジ',
                'product_content' => '自動で温める便利レンジ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 10,
                'name' => 'オートマティックレンジ',
                'product_content' => '自動で温める便利レンジ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 2,
                'product_category_id' => 3,
                'product_subcategory_id' => 14,
                'name' => 'リボン',
                'product_content' => '〇〇高校制服リボン',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            ]);
    }
}
