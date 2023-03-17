<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductTableSeeder extends Seeder
{
    protected string $createdAt = '2023-03-01 12:00:00';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'order_product')->insert([
            [
                'order_id' => 1,
                'product_id' => 3,
                'count' => 1,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 52700,
            ],
            [
                'order_id' => 1,
                'product_id' => 4,
                'count' => 1,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 8500,
            ],
            [
                'order_id' => 1,
                'product_id' => 7,
                'count' => 1,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 9700,
            ],
            [
                'order_id' => 2,
                'product_id' => 2,
                'count' => 5,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 953,
            ],
            [
                'order_id' => 2,
                'product_id' => 5,
                'count' => 5,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 191,
            ],
            [
                'order_id' => 3,
                'product_id' => 2,
                'count' => 2,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 898,
            ],
            [
                'order_id' => 3,
                'product_id' => 4,
                'count' => 1,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 218,
            ],
            [
                'order_id' => 3,
                'product_id' => 5,
                'count' => 1,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 180,
            ],
            [
                'order_id' => 3,
                'product_id' => 6,
                'count' => 1,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 202,
            ],
            [
                'order_id' => 4,
                'product_id' => 7,
                'count' => 7,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 9700,
            ],
            [
                'order_id' => 4,
                'product_id' => 4,
                'count' => 2,
                'created_at' => $this->createdAt,
                'updated_at' => $this->createdAt,
                'price' => 8500,
            ],
        ]);
    }
}
