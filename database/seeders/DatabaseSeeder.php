<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // database/seeders/DatabaseSeeder.php
    public function run()
    {
        $this->call(DivisionSeeder::class);

        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'phone' => '1234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);
    }

}
