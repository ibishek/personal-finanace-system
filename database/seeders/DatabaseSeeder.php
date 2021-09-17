<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\user;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(TransactionTypeSeeder::class);
        $this->call(PaymentModeSeeder::class);
    }
}
