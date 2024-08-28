<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentStatus;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            $number = 1830000000 + $i;
            PaymentStatus::create([
                'key' => 'emdad' . time(),
                'mobile' => '0' . strval($number),
                'amount' => $number - 1830000000
            ]);
        }

        // echo "Seeding done";
    }
}
