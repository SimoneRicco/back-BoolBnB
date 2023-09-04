<?php

namespace Database\Seeders;

use App\Models\ApartmentSponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartment_sponsor = [
            [
                "duration"      => 30,
                "apartment_id"  => "1",
                "sponsor_id"    => "1",
                'subscription_date'     => '2023/07/07',
            ],
            [
                "duration"      => 30,
                "apartment_id"  => "2",
                "sponsor_id"    => "2",
                'subscription_date'     => '2023/07/08',
            ],
            [
                "duration"      => 30,
                "apartment_id"  => "3",
                "sponsor_id"    => "3",
                'subscription_date'     => '2023/07/09',
            ],
        ];

        foreach ($apartment_sponsor as $ap) {
            ApartmentSponsor::create($ap);
        }
    }
}
