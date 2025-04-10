<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Haircut', 'price' => 10],
            ['name' => 'Hair Wash', 'price' => 5],
            ['name' => 'Shaving', 'price' => 4],
            ['name' => 'Beard Trim', 'price' => 6],
            ['name' => 'Head Massage', 'price' => 8],
            ['name' => 'Wash & Blow Dry Combo', 'price' => 12],
            ['name' => 'Hair Coloring', 'price' => 25],
            ['name' => 'Hair Perm', 'price' => 30],
        ];

        foreach ($services as $service) {
            Service::create([
                'name' => $service['name'],
                'price' => $service['price'],
                'status' => 1,
            ]);
        }
    }
}
