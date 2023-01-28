<?php

namespace Database\Seeders;

use App\Models\ServiceAll;
use Illuminate\Database\Seeder;

class ServiceAllSeeder extends Seeder
{
    public function run()
    {
        ServiceAll::factory()->count(5)->create();
    }
}
