<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jon Doe',
            'email' => 'info@jondoe.com',
            'password' => Hash::make('jondoe'),
            'email_verified_at' => now(),
        ]);
    }
}
