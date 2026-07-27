<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed data for Admin table
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'amutwiri07@gmail.com',
            'password' => bcrypt('Rumsadmin!2026'), // Use bcrypt to hash the password
        ]);
    }
}
