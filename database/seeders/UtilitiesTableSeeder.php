<?php

namespace Database\Seeders;

use App\Models\Utility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UtilitiesTableSeeder extends Seeder
{
    public function run()
    {
        foreach(config('utilities') as $objUtility) {

            Utility::create($objUtility);
        }
    }
}
