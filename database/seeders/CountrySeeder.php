<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://countriesnow.space/api/v0.1/countries');

        $countries = $response->json();

        //Log::info($countries['data']);

        foreach ($countries['data'] as $country) {
            //Log::info($country['country']);

            $country_id = Country::create(['name' => $country['country']]);
            foreach ($country['cities'] as $cities){
                City::create(['name' => $cities, 'country_id' => $country_id->id]);
            }
        }
    }
}
