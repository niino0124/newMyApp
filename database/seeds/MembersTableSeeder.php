<?php

use Illuminate\Database\Seeder;

use App\Member;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            [
                'name_sei' => 'ニイノ',
                'name_mei' => 'ヒトミ',
                'nickname' => 'ニーノ',
                'gender' => 2,
                'password' => bcrypt('pass0000'),
                'email' => 'niino@selva-i.co.jp',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name_sei' => 'テスト',
                'name_mei' => 'てすと',
                'nickname' => 'テスト',
                'gender' => 1,
                'password' => bcrypt('pass0000'),
                'email' => 'test@gmail.com',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
        factory(Member::class, 50)->create(); //50個のダミーデータを生成
    }
}
