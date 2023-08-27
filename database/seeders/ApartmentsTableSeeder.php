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

            $slug = Apartment::slugger($objApartment['title']);

            $available = isset($objApartment['available']) ? (bool)$objApartment['available'] : false;


            $apartment = Apartment::create([
                'user_id'           => $objApartment['user_id'],
                // 'address_id'           => $objApartment['address_id'],
                // 'image_id'           => $objApartment['image_id'],
                'title'          => $objApartment['title'],
                'slug'              => $slug,
                'rooms'     => $objApartment['rooms'],
                'beds'           => $objApartment['beds'],
                'bathrooms'    => $objApartment['bathrooms'],
                'square_meters'   => $objApartment['square_meters'],
                'available'        => $available,
            ]);

            $apartment->utilities()->sync($objApartment['utilities']);
            $apartment->sponsors()->sync($objApartment['sponsors']);
        }
    }
}
