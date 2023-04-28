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
    public function run(): void
    {
        $this->call(class: UsersTableSeeder::class);
        $this->call(class: CurrencySeeder::class);
        $this->call(class: ContentSeeder::class);
        $this->call(class: CommentSeeder::class);
    }
}
