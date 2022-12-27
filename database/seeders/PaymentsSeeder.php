<?php

namespace Database\Seeders;

use App\Models\Payments;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payments::factory()->count(5)->create();
    }
}
