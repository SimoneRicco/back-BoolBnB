<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name"      => "Alessio Abbati",
                "email"     => "abbatialessio94@gmail.com",
                "password"  => Hash::make('mandrake117'),
                "image"     => "Alessio.png",
            ],
            [
                "name"      => "Luca Casamassima",
                "email"     => "casamassimaluca723@gmail.com",
                "password"  => Hash::make('luca2001'),
                "image"     => "Luca.png",
            ],
            [
                "name"      => "Nicola Soggiu",
                "email"     => "nicola.soggiu@gmail.com",
                "password"  => Hash::make('nicola96'),
                "image"     => "Nicola.png",
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
