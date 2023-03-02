<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'categories')->insert([
            [
                'name' => 'iPhone',
                'code' => 'iphone',
                'description' => 'Here you can take a look at all Apple iPhones presented at our website',
                'image' => 'categories/iphone_14_pro_ max.jpg',
            ],
            [
                'name' => 'Apple Watch',
                'code' => 'apple_watch',
                'description' => 'Here you can take a look at all Apple Watch presented at our website',
                'image' => 'categories/apple_watch_5.jpg',
            ],
            [
                'name' => 'AirPods',
                'code' => 'airpods',
                'description' => 'Here you can take a look at all Apple AirPods presented at our website',
                'image' => 'categories/airpods_pro_1.jpg',
            ],
        ]);
    }
}
