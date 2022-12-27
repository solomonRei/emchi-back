<?php

namespace Database\Seeders;

use App\Models\Analysis;
use Illuminate\Database\Seeder;

class AnalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Analysis::factory()->count(5)->create();
    }
}
