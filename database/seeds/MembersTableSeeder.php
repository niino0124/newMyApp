<?php

use Illuminate\Database\Seeder;

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
            'name_sei' => '田中',
            'name_mei' => '太朗',
            'nickname' => 'タロー',
            'gender' => 1,
            'password' => Hash::make('password'),
            'email' => Str::random(10).'@gmail.com',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            [
                'name_sei' => '山田',
                'name_mei' => '優子',
                'nickname' => 'ゆう',
                'gender' => 2,
                'password' => Hash::make('password'),
                'email' => Str::random(10).'@gmail.com',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                ],
                [
                    'name_sei' => '鈴木',
                    'name_mei' => '昌',
                    'nickname' => 'マッサー',
                    'gender' => 1,
                    'password' => Hash::make('password'),
                    'email' => Str::random(10).'@gmail.com',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                    ],
                    [
                        'name_sei' => '佐藤',
                        'name_mei' => '健四郎',
                        'nickname' => 'シロー',
                        'gender' => 1,
                        'password' => Hash::make('password'),
                        'email' => Str::random(10).'@gmail.com',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime(),
                        ],
                        [
                            'name_sei' => '大崎',
                            'name_mei' => 'リツコ',
                            'nickname' => 'りっちゃん',
                            'gender' => 2,
                            'password' => Hash::make('password'),
                            'email' => Str::random(10).'@gmail.com',
                            'created_at' => new DateTime(),
                            'updated_at' => new DateTime(),
                            ],
                        [
                            'name_sei' => 'ニイノ',
                            'name_mei' => 'ヒトミ',
                            'nickname' => 'トミ',
                            'gender' => 2,
                            'password' => 'pass0000',
                            'email' => 'niino@selva-i.co.jp',
                            'created_at' => new DateTime(),
                            'updated_at' => new DateTime(),
                            ],

        ]);
    }
}
