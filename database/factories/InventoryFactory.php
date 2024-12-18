<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Perkakasan',
            'Perisian'
        ];

        $items = [
            'Perkakasan' => [
                'Dell Latitude 5420',
                'HP ProBook 450 G8',
                'Lenovo ThinkCentre M720',
                'Brother DCP-L2540DW',
                'Logitech MX Master 3',
                'Kingston 32GB RAM DDR4',
                'Samsung 970 EVO Plus SSD',
            ],
            'Perisian' => [
                'Microsoft Office 365',
                'Adobe Creative Cloud',
                'Windows 11 Pro',
                'Visual Studio 2022',
                'MATLAB R2024a',
                'VMware Workstation Pro',
                'Oracle Database Enterprise',
            ]
        ];

        $category = $this->faker->randomElement($categories);
        
        return [
            'name' => $this->faker->randomElement($items[$category]),
            'quantity' => $this->faker->numberBetween(1, 20),
            'category' => $category,
        ];
    }
} 