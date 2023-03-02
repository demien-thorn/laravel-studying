<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'products')->insert([
            [
                'name' => 'iPhone X',
                'code' => 'iphone_x',
                'description' => 'First non-button Apple smartphone',
                'price' => 26000,
                'category_id' => 1,
                'image' => 'products/iphone_x.jpg',
            ],
            [
                'name' => 'iPhone 12 PRO',
                'code' => 'iphone_12_pro',
                'description' => 'First Apple smartphone with Lidar function',
                'price' => 35000,
                'category_id' => 1,
                'image' => 'products/iphone_12_pro.jpg',
            ],
            [
                'name' => 'iPhone 14 PRO MAX',
                'code' => 'iphone_14_pro_max',
                'description' => 'Best Apple smartphone at the moment',
                'price' => 52700,
                'category_id' => 1,
                'image' => 'products/iphone_14_pro_ max.jpg',
            ],
            [
                'name' => 'Apple Watch 5',
                'code' => 'apple_watch_5',
                'description' => 'Very good smart-watch from Apple',
                'price' => 8500,
                'category_id' => 2,
                'image' => 'products/apple_watch_5.jpg',
            ],
            [
                'name' => 'Apple Watch SE',
                'code' => 'apple_watch_se',
                'description' => 'First budget Apple smart-watch',
                'price' => 7000,
                'category_id' => 2,
                'image' => 'products/apple_watch_se.jpg',
            ],
            [
                'name' => 'AirPods 1',
                'code' => 'airpods_1',
                'description' => 'First wireless Apple earpods',
                'price' => 7850,
                'category_id' => 3,
                'image' => 'products/airpods_1.jpg',
            ],
            [
                'name' => 'AirPods Pro',
                'code' => 'airpods_pro',
                'description' => 'First vacuum wireless Apple earpods',
                'price' => 9700,
                'category_id' => 3,
                'image' => 'products/airpods_pro_1.jpg',
            ],
        ]);
    }
}
