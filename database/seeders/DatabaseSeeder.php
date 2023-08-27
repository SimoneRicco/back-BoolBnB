<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UtilitiesTableSeeder::class,
            UsersTableSeeder::class,
            SponsorsTableSeeder::class,
            ApartmentsTableSeeder::class,
            ViewsTableSeeder::class,
            MessagesTableSeeder::class,
            ImagesTableSeeder::class,
            AddressesTableSeeder::class,
        ]);
        
    }
}
