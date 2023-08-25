<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorTableSeeder extends Seeder
{
    
    public function run()
    {
        $sponsor = [
            [
                "duration"      => 30,
                "apartment_id"  => "1",
                "sponsor_id"    => "1",
            ],
            [
                "duration"      => 30,
                "apartment_id"  => "2",
                "sponsor_id"    => "2",
            ],
            [
                "duration"      => 30,
                "apartment_id"  => "3",
                "sponsor_id"    => "3",
            ],
        ]
    }
}
