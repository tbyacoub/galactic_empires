<?php

use Illuminate\Database\Seeder;

class GlobalRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $globalRates = new \App\GlobalRate([
            'metal_rate' => 1.0,
            'crystal_rate' => 1.0,
            'energy_rate' => 1.0,
            'ship_build_rate' => 1.0,
            'building_build_rate' => 1.0,
            'research_rate' => 1.0,
            'travel_rate' => 1.0,
        ]);
        $globalRates->save();
    }
}
