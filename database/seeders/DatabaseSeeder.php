<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

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
        try {
            DB::beginTransaction();
            $this->call(UserSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(PaymentOptionSeeder::class);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
