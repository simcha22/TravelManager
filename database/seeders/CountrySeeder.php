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
        Log::info($countries['msg']);
        foreach ($countries['data'] as $country) {

            $response_code = Http::post('https://countriesnow.space/api/v0.1/countries/currency', ['country' => $country['country']]);
            $countries_code = $response_code->json();

            Log::info($countries_code['msg']);

            $country_id = Country::create(
                [
                    'name' => $country['country'],
                    'currency' => $countries_code['data']['currency'],
                    'iso2' => $countries_code['data']['iso2'],
                    'iso3' => $countries_code['data']['iso3'],
                ]);

            foreach ($country['cities'] as $cities){
                City::create(['name' => $cities, 'country_id' => $country_id->id]);
            }
        }
    }
}
