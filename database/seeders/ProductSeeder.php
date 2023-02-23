<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'product_category_id' => 1,
                'name' => '商品01',
                'price' => 330000,
                'number' => 'AA-1000',
            ],
            [
                'product_category_id' => 2,
                'name' => '商品02',
                'price' => 30000,
                'number' => 'AA-1001',
            ],
            [
                'product_category_id' => 1,
                'name' => '商品03',
                'price' => 130000,
                'number' => 'AA-1002',
            ],
            [
                'product_category_id' => 2,
                'name' => '商品04',
                'price' => 31000,
                'number' => 'AA-1003',
            ],
            [
                'product_category_id' => 3,
                'name' => '商品05',
                'price' => 130000,
                'number' => 'AA-1004',
            ],
        ]);
    }
}
