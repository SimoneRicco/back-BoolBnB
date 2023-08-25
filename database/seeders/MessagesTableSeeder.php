<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagesTableSeeder extends Seeder
{
    
    public function run()
    {
        $messages = [
            [
                "message"       => "ciao",
                "email"         => "pinco@live.it",
                "apartment_id"  => "1",
            ],
            [
                "message"       => "ciao a tutti",
                "email"         => "pallino@live.it",
                "apartment_id"  => "2",
            ],
            [
                "message"       => "ciao a tutti quanti",
                "email"         => "panco@live.it",
                "apartment_id"  => "3",
            ],
            [
                "message"       => "salute",
                "email"         => "pallo@live.it",
                "apartment_id"  => "4",
            ],

        ];

        foreach ($messages as $message){
            Message::create($message);
        }
    }
}
