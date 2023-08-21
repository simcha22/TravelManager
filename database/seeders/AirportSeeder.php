<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://airport-info.p.rapidapi.com/airport?iata=AAA', [
            'headers' => [
                'X-RapidAPI-Host' => 'airport-info.p.rapidapi.com',
                'X-RapidAPI-Key' => 'bdc5aa2cedmshd71227ddabad660p1a27d5jsnf00032c67347',
            ],
        ]);

        info($response->getBody());
    }
}
