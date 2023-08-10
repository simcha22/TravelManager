<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=> 'Administrator']);
        Role::create(['name'=> 'Editor']);
        Role::create(['name'=> 'User']);
        Role::create(['name'=> 'SuperUser']);
        Role::create(['name'=> 'Client']);
        Role::create(['name'=> 'Travel']);
    }
}
