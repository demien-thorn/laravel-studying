<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    protected string $createdAt = '2023-03-01 12:00:00';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'orders')->insert([
            [
                'status' => 1,
                'name' => 'Demien Thorn',
                'phone' => '+38 (067) 99-07-169',
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'user_id' => 1,
                'currency_id' => 1,
                'sum' => 70900,
            ],
            [
                'status' => 1,
                'name' => 'Kirill Maidanov',
                'phone' => '+380679907169',
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'user_id' => 2,
                'currency_id' => 2,
                'sum' => 5720,
            ],
            [
                'status' => 1,
                'name' => 'Anet Mieluzova',
                'phone' => '+38 (067) 511-98-49',
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'user_id' => 3,
                'currency_id' => 3,
                'sum' => 2396,
            ],
            [
                'status' => 1,
                'name' => 'Кирилл Майданов',
                'phone' => '0679907169',
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'user_id' => 4,
                'currency_id' => 1,
                'sum' => 84900,
            ],
        ]);
    }
}
