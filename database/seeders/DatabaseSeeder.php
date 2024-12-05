<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@sims.com',
            'password' => Hash::make('password'),
            'role' => 'pengurus',
        ]);

        User::factory()->create([
            'name' => 'mock_user',
            'email' => 'mock_user@sims.com',
            'password' => Hash::make('password'),
            'role' => 'pemohon',
        ]);

        Inventory::factory(20)->create();
    }
}
