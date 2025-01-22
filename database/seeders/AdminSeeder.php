<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin1@gmail.com',
            'password' => '?admin?1',
            'phone_number' => '+62 895-3960-83939',
            'role' => 'admin'
        ]);
    }
}
