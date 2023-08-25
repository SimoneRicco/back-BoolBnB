<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ViewsTableSeeder extends Seeder
{
    public function run()
    {
        $views = [
            [
                "ip_address"        => "192.168.1.1",
                "view_date"         => "2023/03/20",
                "apartment_id"      => "1",
            ],
            [
                "ip_address"        => "10.0.0.1",
                "view_date"         => "2023/04/21",
                "apartment_id"      => "2",
            ],
            [
                "ip_address"        => "172.16.0.1",
                "view_date"         => "2023/05/22",
                "apartment_id"      => "3",
            ],
            [
                "ip_address"        => "192.168.0.100",
                "view_date"         => "2023/06/23",
                "apartment_id"      => "4",
            ],

        ];

        foreach ($views as $view){
            View::create($view);
        }
    }
}
