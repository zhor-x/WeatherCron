<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = Storage::get('am.json');

        $data = json_decode($cities);
        foreach ($data as $item) {
            City::create(array(
                'name' => $item->name,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
            ));
        }
    }
}
