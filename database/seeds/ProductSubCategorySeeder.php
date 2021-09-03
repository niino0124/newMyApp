<?php

use Illuminate\Database\Seeder;

class ProductSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_subcategories')->insert([
            [
            'product_category_id' => 1,
            'name' => '収納家具',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 1,
            'name' => '寝具',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 1,
            'name' => 'ソファ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 1,
            'name' => 'ベッド',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 1,
            'name' => '照明',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 2,
            'name' => 'テレビ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 2,
            'name' => '掃除機',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 2,
            'name' => 'エアコン',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 2,
            'name' => '冷蔵庫',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 2,
            'name' => 'レンジ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 3,
            'name' => 'トップス',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 3,
            'name' => 'ボトム',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 3,
            'name' => 'ワンピース',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 3,
            'name' => 'ファッション小物',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 3,
            'name' => 'ドレス',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 4,
            'name' => 'ネイル',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 4,
            'name' => 'アロマ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 4,
            'name' => 'スキンケア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 4,
            'name' => '香水',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 4,
            'name' => 'メイク',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 5,
            'name' => '旅行',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 5,
            'name' => 'ホビー',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 5,
            'name' => '写真集',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 5,
            'name' => '小説',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'product_category_id' => 5,
            'name' => 'ライフスタイル',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],

        ]);

    }
}
