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
            'name' => 'pengurus',
            'email' => 'pengurus@sims.com',
            'password' => Hash::make('123456789'),
            'role' => 'pengurus',
        ]);

        User::factory()->create([
            'name' => 'pemohon',
            'email' => 'pemohon@sims.com',
            'password' => Hash::make('123456789'),
            'role' => 'pemohon',
        ]);

        Inventory::factory(20)->create();
    }
}
