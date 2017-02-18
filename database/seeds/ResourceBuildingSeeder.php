<?php

use Illuminate\Database\Seeder;
use \App\BuildingPrototype;

class ResourceBuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mineral_prototype = \App\BuildingPrototype::where('name', '=', 'Mineral Mine')->first();
        $crystal_prototype = \App\BuildingPrototype::where('name', '=', 'Mineral Mine')->first();
        $energy_prototype = \App\BuildingPrototype::where('name', '=', 'Mineral Mine')->first();

        /*
         * Set the initial base rate (per hour), and the mutiplier rate (per level, 2 : will double every level)
         */
        $this->gatherRateSeeder($mineral_prototype, 10, 1.5);
        $this->gatherRateSeeder($crystal_prototype, 10, 1.5);
        $this->gatherRateSeeder($energy_prototype, 10, 1.5);
    }

    /**
     * @param BuildingPrototype $building_prototype
     * @param $initialBaseRate
     * @param $multiplierRate
     */
    private function gatherRateSeeder(BuildingPrototype $building_prototype, $initialBaseRate, $multiplierRate){

        $max_level = $building_prototype->max_level;
        $id = $building_prototype->id;

        $current_rate = $initialBaseRate;
        for($level = 1; $level <= $max_level; $level++){

            DB::table('resource_buildings')->insert(
                array('level' => $level,
                    'gather_rate' => $current_rate,
                    'building_prototype_id' => $id,
                )
            );

            $current_rate = $current_rate * $multiplierRate;
        }
    }
}
