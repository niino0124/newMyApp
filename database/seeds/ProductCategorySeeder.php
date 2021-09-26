<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
            'name' => 'インテリア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '家電',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'ファッション',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '美容',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '本・雑誌',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'アクセサリー',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'おもちゃ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'スポーツ・アウトドア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '食品',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '車バイク',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '飲料',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'パーティ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '旅行',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '防犯',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'キリスト教',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '天文',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '自然',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'エコロジー',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '機械',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '大学関連',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '建築',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'ヘルスケア',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '異文化交流',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => '地質学',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'name' => 'ホラー',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
        ]);
    }
}
