<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SponsorsTableSeeder extends Seeder
{
    
    public function run()
    {
        foreach (config('sponsors') as $objSponsor) {

            Sponsor::create($objSponsor);
        }
    }
}
