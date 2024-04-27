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
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.id',
            'password' => Hash::make('admin'),
            'is_admin' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'kaiz',
            'email' => 'kaiz@mail.id',
            'password' => Hash::make('kk'),
        ]);
    }
}
