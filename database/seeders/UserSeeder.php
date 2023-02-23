<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '佐藤',
                'email' => 'sato@test.com',
                'password' => Hash::make('password1')
            ],
            [
                'name' => '伊藤',
                'email' => 'ito@test.com',
                'password' => Hash::make('password2')
            ],
            [
                'name' => '加藤',
                'email' => 'kato@test.com',
                'password' => Hash::make('password3')
            ]
        ]);
    }
}
