<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImagesTableSeeder extends Seeder
{
    
    public function run()
    {
        foreach (config('images') as $objImage) {

            Image::create($objImage);
        }
    }
}
