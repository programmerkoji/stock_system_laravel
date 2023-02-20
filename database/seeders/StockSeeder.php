<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'product_id' => 1,
                'stored_date' => "2022-11-30",
                'shipping_date' => "2022-12-01",
                'condition' => 3,
                'serial_number' => 'SS-0003',
                'total' => 2,
                'note' => '備考のメモメモメモメモ',
            ],
            [
                'product_id' => 2,
                'stored_date' => "2022-10-20",
                'shipping_date' => "2022-11-25",
                'condition' => 2,
                'serial_number' => 'SS-0004',
                'total' => 1,
                'note' => '備考のメモメモメモメモ',
            ],
            [
                'product_id' => 1,
                'stored_date' => "2022-11-23",
                'shipping_date' => "2022-12-07",
                'condition' => 4,
                'serial_number' => 'SS-0005',
                'total' => 1,
                'note' => '備考のメモメモメモメモ',
            ],
            [
                'product_id' => 3,
                'stored_date' => "2022-11-30",
                'shipping_date' => "2022-12-07",
                'condition' => 1,
                'serial_number' => 'SS-0006',
                'total' => 1,
                'note' => '備考のメモメモメモメモ',
            ],
        ]);
    }
}
