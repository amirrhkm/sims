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
            'name' => 'user',
            'email' => 'user@sims.com',
            'password' => Hash::make('password'),
            'role' => 'pemohon',
        ]);

        // Seed Perkakasan items
        $perkakasanItems = [
            'Dell Latitude 5420' => 5,
            'HP ProBook 450 G8' => 3,
            'Lenovo ThinkCentre M720' => 4,
            'Brother DCP-L2540DW' => 2,
            'Logitech MX Master 3' => 10,
            'Kingston 32GB RAM DDR4' => 15,
            'Samsung 970 EVO Plus SSD' => 8,
        ];

        foreach ($perkakasanItems as $name => $quantity) {
            Inventory::create([
                'name' => $name,
                'quantity' => $quantity,
                'category' => 'Perkakasan',
            ]);
        }

        // Seed Perisian items
        $perisianItems = [
            'Microsoft Office 365' => 20,
            'Adobe Creative Cloud' => 10,
            'Windows 11 Pro' => 15,
            'Visual Studio 2022' => 8,
            'MATLAB R2024a' => 5,
            'VMware Workstation Pro' => 3,
            'Oracle Database Enterprise' => 2,
        ];

        foreach ($perisianItems as $name => $quantity) {
            Inventory::create([
                'name' => $name,
                'quantity' => $quantity,
                'category' => 'Perisian',
            ]);
        }
    }
}
