<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    protected string $createdAt = '2023-03-01 12:00:00';
    protected string $verifiedAt = '2023-03-01 12:01:00';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(table: 'users')->insert(values: [
            'name' => 'Demien Thorn',
            'email' => 'demien.thornable@gmail.com',
            'email_verified_at' => $this->verifiedAt,
            'created_at' => $this->createdAt,
            'password' => bcrypt(value: 'ytafktv040195'),
            'is_admin' => 1
        ]);
        DB::table(table: 'users')->insert(values: [
            'name' => 'Kirill Maidanov',
            'email' => 'demien.twitter@gmail.com',
            'email_verified_at' => $this->verifiedAt,
            'created_at' => $this->createdAt,
            'password' => bcrypt(value: 'ytafktv040195'),
            'is_admin' => 0
        ]);
        DB::table(table: 'users')->insert(values: [
            'name' => 'Анет Мелузова',
            'email' => 'anna.meluzova@gmail.com',
            'email_verified_at' => $this->verifiedAt,
            'created_at' => $this->createdAt,
            'password' => bcrypt(value: 'ytafktv040195'),
            'is_admin' => 0
        ]);
    }
}
