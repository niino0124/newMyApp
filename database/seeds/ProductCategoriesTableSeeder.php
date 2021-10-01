<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Provider\DateTime; // 追加

class ProductCategoriesTableSeeder extends Seeder
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
            'created_at' => DateTime::dateTimeThisDecade(), // 追加1
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '家電',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'ファッション',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加3
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '美容',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加4
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '本・雑誌',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'アクセサリー',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加6
            'updated_at' => Carbon::now(),
            ],

            [
            'name' => 'おもちゃ',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加7
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'スポーツ・アウトドア',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加8
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '食品',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加9
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '車バイク',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加10
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'パーティ',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '旅',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加12
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '防犯',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'キッズ',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加14
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '季節のお土産',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加15
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '科学',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'エコロジー',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '機械',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加18
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '大学関連',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '建築',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加20
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'ヘルスケア',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加21
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '異文化交流',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => '地質学',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加23
            'updated_at' => Carbon::now(),
            ],
            [
            'name' => 'ホラー',
            'created_at' => DateTime::dateTimeThisDecade(), // 追加24
            'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
