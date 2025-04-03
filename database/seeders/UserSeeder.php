<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Men',
            'email' => 'menlhpc08492@gmail.com',
            'password' => Hash::make('123'),
            'phone' => '0917212223',
            'status' => '1',
            'role' => '2' //2 la admin
        ]);
    }
}
