<?php

namespace Database\Seeders;

use App\Models\ApartmentSponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UtilitiesTableSeeder::class,
            SponsorsTableSeeder::class,
            // ApartmentSponsorTableSeeder::class,
            UsersTableSeeder::class,
            ApartmentsTableSeeder::class,
            ViewsTableSeeder::class,
            MessagesTableSeeder::class,
            ImagesTableSeeder::class,
            AddressesTableSeeder::class,
        ]);
    }
}
