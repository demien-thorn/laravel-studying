<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesTableSeeder extends Seeder
{
    protected string $createdAt = '2023-03-01 12:00:00';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'properties')->insert([
            [
                'name' => 'Color',
                'name_ru' => 'Цвет',
                'created_at' => $this->createdAt,
            ],
            [
                'name' => 'Memory size',
                'name_ru' => 'Объём памяти',
                'created_at' => $this->createdAt,
            ],
        ]);
    }
}
