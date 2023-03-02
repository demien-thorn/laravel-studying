<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    protected string $createdAt = '2023-03-01 12:00:00';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'products')->insert([
            [
                'category_id' => 1,
                'name' => 'iPhone X',
                'code' => 'iphone_x',
                'description' => 'First non-button Apple smartphone',
                'image' => 'products/iphone_x.jpg',
                'price' => 26000,
                'created_at' => $this->createdAt,
                'new' => 0,
                'hit' => 1,
                'recommend' => 0,
                'count' => rand(min: 0, max: 10),
            ],
            [
                'category_id' => 1,
                'name' => 'iPhone 12 PRO',
                'code' => 'iphone_12_pro',
                'description' => 'First Apple smartphone with Lidar function',
                'image' => 'products/iphone_12_pro.jpeg',
                'price' => 35000,
                'created_at' => $this->createdAt,
                'new' => 0,
                'hit' => 1,
                'recommend' => 1,
                'count' => rand(min: 0, max: 10),
            ],
            [
                'category_id' => 1,
                'name' => 'iPhone 14 PRO MAX',
                'code' => 'iphone_14_pro_max',
                'description' => 'Best Apple smartphone at the moment',
                'image' => 'products/iphone_14_pro_ max.jpg',
                'price' => 52700,
                'created_at' => $this->createdAt,
                'new' => 1,
                'hit' => 1,
                'recommend' => 1,
                'count' => rand(min: 0, max: 10),
            ],
            [
                'category_id' => 2,
                'name' => 'Apple Watch 5',
                'code' => 'apple_watch_5',
                'description' => 'Very good smart-watch from Apple',
                'image' => 'products/apple_watch_5.jpg',
                'price' => 8500,
                'created_at' => $this->createdAt,
                'new' => 0,
                'hit' => 1,
                'recommend' => 1,
                'count' => rand(min: 0, max: 10),
            ],
            [
                'category_id' => 2,
                'name' => 'Apple Watch SE',
                'code' => 'apple_watch_se',
                'description' => 'First budget Apple smart-watch',
                'image' => 'products/apple_watch_se.jpg',
                'price' => 7000,
                'created_at' => $this->createdAt,
                'new' => 1,
                'hit' => 0,
                'recommend' => 1,
                'count' => rand(min: 0, max: 10),
            ],
            [
                'category_id' => 3,
                'name' => 'AirPods 1',
                'code' => 'airpods_1',
                'description' => 'First wireless Apple earpods',
                'image' => 'products/airpods_1.jpg',
                'price' => 7850,
                'created_at' => $this->createdAt,
                'new' => 0,
                'hit' => 1,
                'recommend' => 0,
                'count' => rand(min: 0, max: 10),
            ],
            [
                'category_id' => 3,
                'name' => 'AirPods Pro',
                'code' => 'airpods_pro',
                'description' => 'First vacuum wireless Apple earpods',
                'image' => 'products/airpods_pro_1.jpg',
                'price' => 9700,
                'created_at' => $this->createdAt,
                'new' => 0,
                'hit' => 0,
                'recommend' => 1,
                'count' => rand(min: 0, max: 10),
            ],
        ]);
    }
}
