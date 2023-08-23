<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentsTableSeeder extends Seeder
{
    
    public function run()
    {
        foreach (config('apartments') as $objApartment) {


            $apartment = Apartment::create([
                'user_id'           => $objApartment['user_id'],
                'title'          => $objApartment['title'],
                'rooms'     => $objApartment['rooms'],
                'beds'           => $objApartment['beds'],
                'bathrooms'    => $objApartment['bathrooms'],
                'square_meters'   => $objApartment['square_meters'],
                'address'   => $objApartment['address'],
                'visible'        => $objApartment['visible'],
            ]);

            $apartment->utilities()->sync($objApartment['utilities']);
        }
    }
}
