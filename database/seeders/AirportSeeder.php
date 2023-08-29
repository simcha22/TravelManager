<?php

namespace Database\Seeders;

use App\Models\Airport;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_files = $this->arrayData();

        foreach ($array_files as $file) {
            $csvData = fopen(base_path('database/csv/AIRPORTS_' . $file . '.csv'), 'r');
            $transRow = true;
            while (($data = fgetcsv($csvData, 555, ',')) !== false) {
                if (!$transRow) {
                    $this->createAirport($data);
                }
                $transRow = false;
            }
            fclose($csvData);
        }
    }

    public function arrayData(): array
    {
        return ['A','B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    }

    public function createAirport($data): void
    {
        $airport = $this->getMoreInfo($data['0']);

        if (array_key_exists('error', $airport)) {
            Airport::create([
                'name' => $data['2'],
                'iata_code' => $data['0'],
                'icao_code' => $data['1'],
                'location' => $data['3'],
            ]);
        } else {
            if (array_key_exists('country_iso', $airport)) {
                $country = Country::where('iso2', $airport['country_iso'])->orWhere('name', $airport['country'])->pluck('id');
            } else {
                $country = [];
            }

            if (array_key_exists('city', $airport)) {
                $city = City::where('name', $airport['city'])->pluck('id');
            } else {
                $city = [];
            }

            Airport::create([
                'name' => $data['2'],
                'iata_code' => $data['0'],
                'icao_code' => $data['1'],
                'location' => $data['3'],
                'postal_code' => array_key_exists('postal_code', $airport) ? $airport['postal_code'] : null,
                'phone' => array_key_exists('phone', $airport) ? $airport['phone'] : null,
                'latitude' => array_key_exists('latitude', $airport) ? $airport['latitude'] : null,
                'longitude' => array_key_exists('longitude', $airport) ? $airport['longitude'] : null,
                'uct' => array_key_exists('uct', $airport) ? $airport['uct'] : null,
                'website' => array_key_exists('website', $airport) ? $airport['website'] : null,
                'country_id' => !empty($country[0]) ? $country[0] : null,
                'city_id' => !empty($city[0]) ? $city[0] : null,
            ]);
        }
    }

    public function getMoreInfo($code)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'airport-info.p.rapidapi.com',
            'X-RapidAPI-Key' => 'bdc5aa2cedmshd71227ddabad660p1a27d5jsnf00032c67347',
        ])->get('https://airport-info.p.rapidapi.com/airport?iata=' . $code);

        info($response->json());
        return $response->json();
    }
}
