<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\Order;
use App\Models\Driver;
use Illuminate\Database\Seeder;

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
        // $this->call(PaymentStatusSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(BookSeeder::class);
        // // $this->call(OrderSeeder::class);
        // Order::factory()->count(15)->create();
        // $this->call(PaymentStatusSeeder::class);

        Driver::factory()->count(10)->create();
        Trip::factory()->count(50)->create();
    }
}
