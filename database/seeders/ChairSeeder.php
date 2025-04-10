<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chair;

class ChairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Chair::factory()->count(3)->create();
    }
}
