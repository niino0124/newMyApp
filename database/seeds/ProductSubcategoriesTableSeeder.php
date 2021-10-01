<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Provider\DateTime; // 追加
use App\ProductSubcategory;
use App\ProductCategory;
use App\Product;

class ProductSubcategoriesTableSeeder extends Seeder
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
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 1,
                'name' => '寝具',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 1,
                'name' => 'ソファ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 1,
                'name' => 'ベッド',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 1,
                'name' => '照明',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 2,
                'name' => 'テレビ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 2,
                'name' => '掃除機',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 2,
                'name' => 'エアコン',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 2,
                'name' => '冷蔵庫',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 2,
                'name' => 'レンジ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 3,
                'name' => 'トップス',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 3,
                'name' => 'ボトム',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 3,
                'name' => 'ワンピース',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 3,
                'name' => 'ファッション小物',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 3,
                'name' => 'ドレス',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 4,
                'name' => 'ネイル',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 4,
                'name' => 'アロマ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 4,
                'name' => 'スキンケア',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 4,
                'name' => '香水',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 4,
                'name' => 'メイク',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 5,
                'name' => '旅行',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 5,
                'name' => 'ホビー',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 5,
                'name' => '写真集',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 5,
                'name' => '小説',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 5,
                'name' => 'ライフスタイル',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 6,
                'name' => '仮面ライダー',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 6,
                'name' => 'プリキュア',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 6,
                'name' => 'Wii',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 6,
                'name' => '遊具',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 6,
                'name' => '裁縫',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 7,
                'name' => 'ラケット',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 7,
                'name' => 'ボール',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 7,
                'name' => '白線',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 7,
                'name' => 'キャップ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 7,
                'name' => '速乾製品',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 8,
                'name' => 'インド料理',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 8,
                'name' => 'タイ料理',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 8,
                'name' => '日本食',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 8,
                'name' => '中華調理',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 9,
                'name' => 'バブ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 10,
                'name' => 'サプライズ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 10,
                'name' => 'おもしろ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 10,
                'name' => 'ドキドキ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 10,
                'name' => 'みんなで作ろう',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 10,
                'name' => 'ボードゲーム',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 11,
                'name' => 'スーツケース',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 11,
                'name' => '地球の歩き方',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 12,
                'name' => '護身',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 12,
                'name' => '監視',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 12,
                'name' => 'セコム',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 13,
                'name' => 'キッズ製品',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 13,
                'name' => 'ベイビー製品',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 13,
                'name' => 'お助け',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 14,
                'name' => 'お歳暮',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 14,
                'name' => 'ポチ袋',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 14,
                'name' => '季節の彩り',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 14,
                'name' => 'お中元',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 15,
                'name' => '薬品',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 15,
                'name' => '備品類',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 16,
                'name' => '水質',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 16,
                'name' => '大気',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 17,
                'name' => 'ロボット系',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 17,
                'name' => '工具系',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 18,
                'name' => '大学教本',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 18,
                'name' => '受験対策',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 19,
                'name' => '木材',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 19,
                'name' => '工具系',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 19,
                'name' => '塗装',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 20,
                'name' => '薬',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 21,
                'name' => 'カメラ',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 21,
                'name' => '世界の料理',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 21,
                'name' => '言語教室',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 22,
                'name' => '地質検査機',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                    'product_category_id' => 23,
                    'name' => '地質改善',
                    'created_at' => DateTime::dateTimeThisDecade(), // 追加
                    'updated_at' => Carbon::now(),
                ],
                [
                    'product_category_id' => 23,
                    'name' => '肥料',
                    'created_at' => DateTime::dateTimeThisDecade(), // 追加
                    'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 24,
                'name' => '血糊系',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],
                [
                'product_category_id' => 24,
                'name' => '鑑賞系',
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
                ],

            ]);
        }


    }
