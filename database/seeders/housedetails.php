<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class housedetails extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //demodata for Housedetails table
        DB::table('Housedetails')->insert([
            'id' => 1,
            'type' => 'Apartment',
            'location' => 'Nyeri',
            'description' => 'A cozy apartment in the heart of the city. Free wifi and parking included.',
            'rate' => 1200,


        ]);
        DB::table('Housedetails')->insert([
            'id' => 2,
            'type' => 'Bedsitter',
            'location' => 'Nairobi',
            'description' => 'A modern condo with a beautiful view. Includes gym access.',
            'rate' => 1500,
        ]);
        DB::table('Housedetails')->insert([
            'id' => 3,
            'type' => 'Apartment',
            'location' => 'Embu',
            'description' => 'A spacious house with a backyard. Perfect for families.',
            'rate' => 2000,
        ]); 
       
    }
}
