<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cities = [

            // Bahawalpur Sector
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'Bahawalpur', 'application_limit' => 12000],
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'Bahawal Nagar', 'application_limit' => 4000],
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'Rahim Yar Khan', 'application_limit' => 3000],
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'Muzaffar Garh', 'application_limit' => 3000],
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'D.I Khan', 'application_limit' => 3000],
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'Lohdran', 'application_limit' => 4000],
            ['sector' => 'Bahawalpur Sector', 'city_name' => 'D.G Khan', 'application_limit' => 3000],

            // Multan Sector
            ['sector' => 'Multan Sector', 'city_name' => 'Multan', 'application_limit' => 15000],
            ['sector' => 'Multan Sector', 'city_name' => 'Khanewal', 'application_limit' => 4000],
            ['sector' => 'Multan Sector', 'city_name' => 'Vehari', 'application_limit' => 4000],
            ['sector' => 'Multan Sector', 'city_name' => 'Sahiwal', 'application_limit' => 6000],

            // Faisalabad Sector
            ['sector' => 'Faisalabad Sector', 'city_name' => 'Faisalabad', 'application_limit' => 18000],
            ['sector' => 'Faisalabad Sector', 'city_name' => 'Okara', 'application_limit' => 9000],
            ['sector' => 'Faisalabad Sector', 'city_name' => 'Chanioat', 'application_limit' => 3000],

            // Sargodha Sector
            ['sector' => 'Sargodha Sector', 'city_name' => 'Sargodha', 'application_limit' => 6000],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Layya', 'application_limit' => 1500],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Bhakkar', 'application_limit' => 1500],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Jhang', 'application_limit' => 4000],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Mianwali', 'application_limit' => 2000],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Khushab', 'application_limit' => 2000],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Hafizabad', 'application_limit' => 6000],
            ['sector' => 'Sargodha Sector', 'city_name' => 'Sheikhupura', 'application_limit' => 6000],

            // Sialkot Sector
            ['sector' => 'Sialkot Sector', 'city_name' => 'Sialkot', 'application_limit' => 18000],
            ['sector' => 'Sialkot Sector', 'city_name' => 'Narowal', 'application_limit' => 4000],
            ['sector' => 'Sialkot Sector', 'city_name' => 'Shakrgarh', 'application_limit' => 4000],

            // Islamabad Sector
            ['sector' => 'Islamabad Sector', 'city_name' => 'Islamabad', 'application_limit' => 18000],
            ['sector' => 'Islamabad Sector', 'city_name' => 'Chakwal', 'application_limit' => 3000],
            ['sector' => 'Islamabad Sector', 'city_name' => 'Jhelum', 'application_limit' => 3000],
            ['sector' => 'Islamabad Sector', 'city_name' => 'Gujrat', 'application_limit' => 4000],
            ['sector' => 'Islamabad Sector', 'city_name' => 'Wazirabad', 'application_limit' => 3000],
            ['sector' => 'Islamabad Sector', 'city_name' => 'Quetta', 'application_limit' => 9000],

            // Lahore Sector
            ['sector' => 'Lahore Sector', 'city_name' => 'Lahore', 'application_limit' => 21000],
            ['sector' => 'Lahore Sector', 'city_name' => 'Qasoor', 'application_limit' => 4000],

            // Gujranwala Sector
            ['sector' => 'Gujranwala Sector', 'city_name' => 'Gujranwala', 'application_limit' => 15000],
            ['sector' => 'Gujranwala Sector', 'city_name' => 'TT Sing', 'application_limit' => 3000],
            ['sector' => 'Gujranwala Sector', 'city_name' => 'Mandi Bah Ud Din', 'application_limit' => 3000],

            // Peshawar Sector
            ['sector' => 'Peshawar Sector', 'city_name' => 'Peshawar', 'application_limit' => 15000],
            ['sector' => 'Peshawar Sector', 'city_name' => 'Mardan', 'application_limit' => 3000],
            ['sector' => 'Peshawar Sector', 'city_name' => 'Nowshehra', 'application_limit' => 3000],
            ['sector' => 'Peshawar Sector', 'city_name' => 'Abbotabad', 'application_limit' => 3000],
            ['sector' => 'Peshawar Sector', 'city_name' => 'Haripur', 'application_limit' => 2000],
            ['sector' => 'Peshawar Sector', 'city_name' => 'Manshera', 'application_limit' => 3000],

            // Haiderabad Sector
            ['sector' => 'Haiderabad Sector', 'city_name' => 'Haiderabad', 'application_limit' => 12000],
            ['sector' => 'Haiderabad Sector', 'city_name' => 'Sangahar', 'application_limit' => 4000],
            ['sector' => 'Haiderabad Sector', 'city_name' => 'Khair Pur', 'application_limit' => 4000],
            ['sector' => 'Haiderabad Sector', 'city_name' => 'Ghotki', 'application_limit' => 4000],
            ['sector' => 'Haiderabad Sector', 'city_name' => 'Sakkar', 'application_limit' => 4000],

            // Karachi Sector
            ['sector' => 'Karachi Sector', 'city_name' => 'Karachi Central', 'application_limit' => 8000],
            ['sector' => 'Karachi Sector', 'city_name' => 'Karachi West', 'application_limit' => 8000],
            ['sector' => 'Karachi Sector', 'city_name' => 'Karachi East', 'application_limit' => 8000],
            ['sector' => 'Karachi Sector', 'city_name' => 'Karachi North', 'application_limit' => 8000],
            ['sector' => 'Karachi Sector', 'city_name' => 'Maleer', 'application_limit' => 8000],

        ];

        City::insert($cities);
    }
}
