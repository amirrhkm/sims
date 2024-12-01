<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Laptop',
            'Desktop',
            'Monitor',
            'Keyboard',
            'Mouse',
            'Headset',
            'Webcam',
            'Cable',
            'Adapter',
            'Network Equipment',
            'Storage Device',
            'Printer',
        ];

        $items = [
            'Laptop' => ['Dell XPS 13', 'MacBook Pro 14"', 'Lenovo ThinkPad X1', 'HP Elitebook'],
            'Desktop' => ['Dell OptiPlex', 'HP WorkStation', 'Mac Mini', 'Custom Build PC'],
            'Monitor' => ['Dell 27" 4K', 'LG 32" Ultrawide', 'Samsung 24" HD', 'ASUS ProArt Display'],
            'Keyboard' => ['Logitech MX Keys', 'Apple Magic Keyboard', 'Keychron K2', 'Microsoft Ergonomic'],
            'Mouse' => ['Logitech MX Master', 'Apple Magic Mouse', 'Microsoft Surface Mouse', 'Razer Pro Click'],
            'Headset' => ['Jabra Evolve 75', 'Sony WH-1000XM4', 'Logitech Zone Wireless', 'Plantronics Voyager'],
            'Webcam' => ['Logitech C920', 'Logitech Brio', 'Microsoft LifeCam', 'AUSDOM AF640'],
            'Cable' => ['HDMI 2.0 Cable', 'USB-C Cable', 'DisplayPort Cable', 'Ethernet Cable'],
            'Adapter' => ['USB-C to HDMI', 'DisplayPort to HDMI', 'USB-C Hub', 'Ethernet Adapter'],
            'Network Equipment' => ['Cisco Switch', 'UniFi Access Point', 'Network Cable Tester', 'Patch Panel'],
            'Storage Device' => ['Samsung T7 SSD', 'WD My Passport', 'Seagate Backup Plus', 'SanDisk Extreme PRO'],
            'Printer' => ['HP LaserJet Pro', 'Brother MFC', 'Epson WorkForce', 'Canon PIXMA'],
        ];

        $category = $this->faker->randomElement($categories);
        
        return [
            'name' => $this->faker->randomElement($items[$category]),
            'quantity' => $this->faker->numberBetween(1, 20),
            'category' => $category,
        ];
    }
} 