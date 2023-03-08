<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'currencies')->truncate();
        DB::table(table: 'currencies')->insert(values: [
            [
                'code' => 'UAH',
                'symbol' => '₴',
                'is_main' => '1',
                'rate' => '1',
            ],
            [
                'code' => 'USD',
                'symbol' => '$',
                'is_main' => '0',
                'rate' => '38',
            ],
            [
                'code' => 'EUR',
                'symbol' => '€',
                'is_main' => '0',
                'rate' => '40',
            ],
        ]);
    }
}