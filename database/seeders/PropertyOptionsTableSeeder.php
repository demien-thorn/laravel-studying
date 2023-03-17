<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyOptionsTableSeeder extends Seeder
{
    protected string $createdAt = '2023-03-01 12:00:00';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'property_options')->insert([
            [
                'property_id' => 1,
                'name' => 'Black',
                'name_ru' => 'Чёрный',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 1,
                'name' => 'White',
                'name_ru' => 'Белый',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 1,
                'name' => 'Aqua Blue',
                'name_ru' => 'Синий аква',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 1,
                'name' => 'Cosimic Red',
                'name_ru' => 'Космический красный',
                'created_at' => $this->createdAt,
            ],

            [
                'property_id' => 2,
                'name' => '16 GB',
                'name_ru' => '16 ГБ',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 2,
                'name' => '32 GB',
                'name_ru' => '32 ГБ',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 2,
                'name' => '64 GB',
                'name_ru' => '64 ГБ',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 2,
                'name' => '128 GB',
                'name_ru' => '128 ГБ',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 2,
                'name' => '256 GB',
                'name_ru' => '256 ГБ',
                'created_at' => $this->createdAt,
            ],
            [
                'property_id' => 2,
                'name' => '512 GB',
                'name_ru' => '512
                 ГБ',
                'created_at' => $this->createdAt,
            ],
        ]);
    }
}
