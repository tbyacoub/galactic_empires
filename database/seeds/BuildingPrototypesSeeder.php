<?php

use Illuminate\Database\Seeder;

class BuildingPrototypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        * Include here the different types of buildings.
        */
        $resource_building_prototypes = ['Mineral Mine', 'Crystal Mine', 'Energy Reactor'];
        $military_building_prototypes = ['Fleet Shipyard'];
        $defense_building_prototypes = ['Missile Silo'];


        /*
        * Building cost, level, time modifiers.
        */
        $resources_buildings_modifiers = array(
            'building_cost_modifier' => 2,
            'initial_building_res_cost' => 100,

            'building_time_modifier' => 2,
            'initial_building_time_cost' => 15, // In minutes

            'max_building_level' => 10
        );

        $military_buildings_modifiers = array(
            'building_cost_modifier' => 2,
            'initial_building_res_cost' => 200,

            'building_time_modifier' => 2,
            'initial_building_time_cost' => 20, // In minutes

            'max_building_level' => 10
        );

        $defense_buildings_modifiers = array(
            'building_cost_modifier' => 2,
            'initial_building_res_cost' => 50,

            'building_time_modifier' => 2,
            'initial_building_time_cost' => 10, // In minutes

            'max_building_level' => 10
        );


        /*
         * Function for adding Resource Specific Building information.
         */
        $this->insertPrototypeInformation($resource_building_prototypes, $resources_buildings_modifiers);

        /*
         * Function for adding Fleet Specific Building information.
         */
        $this->insertPrototypeInformation($military_building_prototypes, $military_buildings_modifiers);

        /*
        * Function for adding 'Others Type' Building information.
        */
        $this->insertPrototypeInformation($defense_building_prototypes, $defense_buildings_modifiers);
    }


    /**
    *  Add all the different building prototypes into the DB.
    *
    * @param array of the names of the prototypes.
    * @param array of the building costs, levels, and time modifiers.
    */
    private function insertPrototypeInformation($names_array, $modifiers){

        $building_cost_modifier = $modifiers['building_cost_modifier'];
        $initial_building_res_cost = $modifiers['initial_building_res_cost'];

        $building_time_modifier = $modifiers['building_time_modifier'];
        $initial_building_time_cost = $modifiers['initial_building_time_cost'];

        $max_building_level = $modifiers['max_building_level'];

        foreach ($names_array as $name){

            $inserted_id = DB::table('building_prototypes')->insertGetId(
                array('name' => $name,
                    'img_path' => "assets/img/buildings/img_". str_replace(' ', '', $name).".jpg",
                    'max_level' => $max_building_level,
                )
            );

            /*
             * Add the different cost per level for each prototype.
             */
            $resource_cost = $initial_building_res_cost;
            $time_cost = $initial_building_time_cost;
            for($level = 1; $level <= $max_building_level; $level++){

                DB::table('building_costs')->insert(
                    array(  'level'   => $level,
                        'mineral' => $resource_cost,
                        'crystal' => $resource_cost,
                        'energy'  => $resource_cost,
                        'minutes' => $time_cost,
                        'building_prototype_id' => $inserted_id,
                    )
                );

                $resource_cost = $resource_cost * $building_cost_modifier;
                $time_cost = $time_cost * $building_time_modifier;
            }
        }
    }

}
