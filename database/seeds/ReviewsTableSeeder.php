<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            [
            'member_id' => '6',
            'product_id' => '26',
            'evaluation' => '5',
            'comment' => '最高品質は嘘じゃなかった',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'member_id' => '5',
            'product_id' => '26',
            'evaluation' => '1',
            'comment' => '前とほぼ展開同じで辟易',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'member_id' => '4',
            'product_id' => '26',
            'evaluation' => '5',
            'comment' => 'beeの時から洗練されてるのがよくわかる。進化を感じられてとても楽しかった。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'member_id' => '3',
            'product_id' => '26',
            'evaluation' => '3',
            'comment' => '高揚感はなかった',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'member_id' => '2',
            'product_id' => '26',
            'evaluation' => '5',
            'comment' => '野田作品の集大成であると感じられた。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'member_id' => '2',
            'product_id' => '2',
            'evaluation' => '5',
            'comment' => 'とてもいい！！',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
            'member_id' => '4',
            'product_id' => '2',
            'evaluation' => '4',
            'comment' => '気に入ったので、家族にも買ってあげた',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            
        ]);
    }
}
