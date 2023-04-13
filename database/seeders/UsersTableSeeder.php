<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table(table: 'users')->insert(values: [
            [
                'name' => 'Demien Thorn',
                'email' => 'demien.thornable@gmail.com',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'password' => bcrypt(value: 'ytafktv040195'),
                'is_admin' => 1
            ],
            [
                'name' => 'Kirill Maidanov',
                'email' => 'demien.twitter@gmail.com',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'password' => bcrypt(value: 'ytafktv040195'),
                'is_admin' => 0
            ],
            [
                'name' => 'Анет Мелузова',
                'email' => 'anna.meluzova@gmail.com',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'password' => bcrypt(value: 'ytafktv040195'),
                'is_admin' => 0
            ]
        ]);
    }
}
