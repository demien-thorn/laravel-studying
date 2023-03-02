<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'users')->insert(values: [
            'name' => 'Администратор',
            'email' => 'admin@example.com',
            'password' => bcrypt(value: 'admin'),
            'is_admin' => 1
        ]);
    }
}
