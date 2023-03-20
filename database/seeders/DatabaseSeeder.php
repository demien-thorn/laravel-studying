<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(class: UsersTableSeeder::class);
        $this->call(class: CategoriesTableSeeder::class);
        $this->call(class: ProductsTableSeeder::class);
        $this->call(class: CurrencySeeder::class);

        $this->call(class: PropertiesTableSeeder::class);
        $this->call(class: PropertyOptionsTableSeeder::class);
    }
}
