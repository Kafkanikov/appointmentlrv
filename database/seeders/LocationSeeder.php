<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Conference Room A',
                'description' => 'Large conference room with video conferencing capabilities',
                'address' => '123 Business St, Floor 2',
                'floor' => '2nd Floor',
                'capacity' => 12,
                'equipment' => ['Projector', 'Whiteboard', 'Video Conference', 'Coffee Machine'],
                'is_active' => true,
            ],
            [
                'name' => 'Meeting Room B',
                'description' => 'Small meeting room perfect for intimate discussions',
                'address' => '123 Business St, Floor 3',
                'floor' => '3rd Floor',
                'capacity' => 6,
                'equipment' => ['TV Screen', 'Whiteboard'],
                'is_active' => true,
            ],
            [
                'name' => 'Executive Boardroom',
                'description' => 'Premium boardroom for executive meetings',
                'address' => '123 Business St, Floor 5',
                'floor' => '5th Floor',
                'capacity' => 20,
                'equipment' => ['Smart Board', 'Audio System', 'Climate Control', 'Catering'],
                'is_active' => true,
            ],
            [
                'name' => 'Training Room',
                'description' => 'Large training room with flexible seating arrangements',
                'address' => '123 Business St, Floor 1',
                'floor' => 'Ground Floor',
                'capacity' => 30,
                'equipment' => ['Projector', 'Sound System', 'Flexible Tables'],
                'is_active' => true,
            ],
            [
                'name' => 'Private Office 101',
                'description' => 'Quiet private office for one-on-one meetings',
                'address' => '123 Business St, Floor 1',
                'floor' => 'Ground Floor',
                'capacity' => 3,
                'equipment' => ['Desk', 'Computer', 'Phone'],
                'is_active' => true,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
