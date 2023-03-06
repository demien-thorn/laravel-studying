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
                'name_ru' => 'Айфон',
                'code' => 'iphone',
                'description' => 'Here you can take a look at all Apple iPhones presented at our website',
                'description_ru' => 'Здесь вы можете взглянуть на все Apple iPhone, представленные на нашем сайте',
                'image' => 'categories/iphone_14_pro_ max.jpg',
            ],
            [
                'name' => 'Apple Watch',
                'name_ru' => 'Эпл Вотч',
                'code' => 'apple_watch',
                'description' => 'Here you can take a look at all Apple Watch presented at our website',
                'description_ru' => 'Здесь вы можете взглянуть на все Apple Watch, представленные на нашем сайте.',
                'image' => 'categories/apple_watch_5.jpg',
            ],
            [
                'name' => 'AirPods',
                'name_ru' => 'ЭйрПодс',
                'code' => 'airpods',
                'description' => 'Here you can take a look at all Apple AirPods presented at our website',
                'description_ru' => 'Здесь вы можете взглянуть на все Apple AirPods, представленные на нашем сайте.',
                'image' => 'categories/airpods_pro_1.jpg',
            ],
        ]);
    }
}
