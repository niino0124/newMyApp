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
        ]);
    }
}
