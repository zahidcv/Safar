<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Carbon;
use App\Jobs\SeedOrdersJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Set memory limit and max execution time
        ini_set('memory_limit', '2048M'); // Increase memory limit to 2GB
        ini_set('max_execution_time', '600'); // 600 seconds = 10 minutes


        echo "working";
        Log::info("Seeder started");

        Order::truncate();

        $books = Book::pluck('id')->all();
        $users = User::pluck('id')->all();
        $date = Carbon::now()->subYears(5);
        $endDate = Carbon::now();

        while ($date->lte($endDate)) {
            $orders = [];
            $orderCount = rand(50, 100);

            for ($i = 0; $i < $orderCount; $i++) {
                $orders[] = [
                    'book_id' => $books[array_rand($books)],
                    'quantity' => rand(1, 10),
                    'user_id' => $users[array_rand($users)],
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }

            // Dispatch job for each day's orders
            Bus::dispatch(new SeedOrdersJob($orders));
            Log::info("Dispatched orders for date: {$date->toDateString()} with {$orderCount} orders");

            $date->addDay();
        }

        Log::info("Seeding completed");
    }
}
