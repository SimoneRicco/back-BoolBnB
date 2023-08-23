<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('apartments') as $objApartment) {

            $slug = Apartment::slugger($objApartment['title']);


            $apartment = Apartment::create([
                'title'          => $objApartment['title'],
                'slug'              => $slug,
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
