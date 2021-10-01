<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
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
                'image_1' => 'images-23.jpg',
                'image_2' => 'images-25.jpg',
                'product_content' => 'いいテレビに関する説明',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 1,
                'product_category_id' => 1,
                'product_subcategory_id' => 5,
                'name' => 'HUE照明',
                'image_1' => 'images-24.jpg',
                'image_2' => 'images-25.jpg',
                'product_content' => '室内を自由に彩る間接照明',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 10,
                'name' => 'オートマティックレンジ',
                'image_1' => 'images-22.jpg',
                'image_2' => '',
                'product_content' => '自動で温める便利レンジ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 10,
                'name' => 'グルグルレンジ',
                'image_1' => 'images-22.jpg',
                'image_2' => '',
                'product_content' => '手動で温める便利レンジ便利レンジ便利レンジ便利レンジ便利レンジ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 2,
                'product_category_id' => 3,
                'product_subcategory_id' => 14,
                'name' => 'リボン',
                'image_1' => '',
                'image_2' => '',
                'product_content' => '髪を括れる！リボン',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 8,
                'name' => 'スマホ19',
                'image_1' => 'images-1.jpg',
                'image_2' => 'images.jpg',
                'product_content' => 'すごいスマホ。すごいスマホすごいスマホすごいスマホすごいスマホすごいスマホすごいスマホすごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 4,
                'product_category_id' => 2,
                'product_subcategory_id' => 10,
                'name' => 'ロボット１０',
                'image_1' => 'images.png',
                'image_2' => 'images-1.png',
                'product_content' => 'すごいロボ。すごいロボすごいロボすごいロボすごいロボすごいロボすごいロボすごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 5,
                'product_category_id' => 4,
                'product_subcategory_id' => 18,
                'name' => '日焼け止めスーパー',
                'image_1' => 'images-17.jpg',
                'image_2' => 'images-18.jpg',
                'product_content' => 'すごい日焼け止め。すごい日焼け止めすごい日焼け止めすごい日焼け止めすごい日焼け止めすごい日焼け止めすごい日焼け止めすごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 4,
                'product_subcategory_id' => 18,
                'name' => '日焼け止めスーパーDX',
                'image_1' => 'images-19.jpg',
                'image_2' => 'images-17.jpg',
                'product_content' => 'すごい大容量。すごい大容量すごい大容量すごい大容量すごい大容量すごい大容量すごい大容量すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 4,
                'product_subcategory_id' => 19,
                'name' => 'アロマスーパーDX',
                'image_1' => 'images-13.jpg',
                'image_2' => 'images-12.jpg',
                'product_content' => 'すごいリラックス。すごいリラックスすごいリラックスすごいリラックスすごいリラックスすごいリラックスすごいリラックスすごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 7,
                'product_category_id' => 5,
                'product_subcategory_id' => 22,
                'name' => '日焼け止め専門書',
                'image_1' => 'images-11.jpg',
                'image_2' => 'images-12.jpg',
                'product_content' => 'すごい内容。すごい内容すごい内容すごい内容すごい内容すごい内容すごい内容すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 9,
                'name' => 'スーパーDXカメラ',
                'image_1' => '69477195.jpg',
                'image_2' => '',
                'product_content' => 'すごい高画質。すごい高画質すごい高画質すごい高画質すごい高画質すごい高画質すごい高画質すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 1,
                'product_subcategory_id' => 3,
                'name' => 'ヨガマットスーパーDX',
                'image_1' => 'images-8.jpg',
                'image_2' => 'images-9.jpg',
                'product_content' => '丸めて簡単。丸めて簡単すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 3,
                'product_subcategory_id' => 13,
                'name' => 'メカ時計',
                'image_1' => 'images-5.jpg',
                'image_2' => 'images-6.jpg',
                'product_content' => 'すごいスマート時計。すごいスマート時計すごいスマート時計すごいスマート時計すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 2,
                'product_subcategory_id' => 10,
                'name' => '古き音',
                'image_1' => 'images-15.jpg',
                'image_2' => 'images-16.jpg',
                'product_content' => 'すごい重厚感。すごい重厚感すごい重厚感すごい重厚感すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'member_id' => 3,
                'product_category_id' => 3,
                'product_subcategory_id' => 13,
                'name' => 'プラ野菜',
                'image_1' => 'images-20.jpg',
                'image_2' => 'images-21.jpg',
                'product_content' => 'すごい本物感。すごい本物感すごい本物感すごい本物感すごい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            ]);

            factory(Product::class, 50)->create();

        //     ->each(function () {
        //         factory(App\Review::class, 5)->make();
        //     }
        // );

    }
}
