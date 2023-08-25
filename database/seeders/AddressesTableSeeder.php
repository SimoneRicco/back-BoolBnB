<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressesTableSeeder extends Seeder
{
    
    public function run()
    {
        foreach (config('addresses') as $objAddress) {

            Address::create($objAddress);
        }
    }
}
