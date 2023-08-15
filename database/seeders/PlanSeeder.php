<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'free',
            'price' => 0,
            'count_of_users' => 1,
            'count_of_groups' => 0,
            'count_of_travels' => 1,
            'count_of_advertisements' => 5,
            'count_of_tracks' => 5,
            'count_of_documents' => 20,
            'count_of_notifications' => 100,
            'count_of_travel_operations' => 100,
            'type_of_calk' => 'experience',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Plan::create([
            'name' => 'Regular - Monthly',
            'price' => 10,
            'count_of_users' => 5,
            'count_of_groups' => 1,
            'count_of_travels' => 1,
            'count_of_advertisements' => 50,
            'count_of_tracks' => 50,
            'count_of_documents' => 100,
            'count_of_notifications' => 1000,
            'count_of_travel_operations' => 200,
            'type_of_calk' => 'monthly',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Plan::create([
            'name' => 'Regular - Yearly',
            'price' => 100,
            'count_of_users' => 10,
            'count_of_groups' => 5,
            'count_of_travels' => 20,
            'count_of_advertisements' => 700,
            'count_of_tracks' => 700,
            'count_of_documents' => 2000,
            'count_of_notifications' => -1,
            'count_of_travel_operations' => -1,
            'type_of_calk' => 'yearly',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
