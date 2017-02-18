<?php

use Illuminate\Database\Seeder;

class BuildingTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertResourceBuildingSpecifics();
        $this->insertShipyardBuildingsSpecifics();
        $this->insertDefenseBuildingsSpecifics();
        $this->insertFacilityBuildingsSpecifics();
    }


    private function insertResourceBuildingSpecifics(){
        // Below add Building Specific Information to its respective Table

    }


    private function insertShipyardBuildingsSpecifics(){

        // Below add Building Specific Information to its respective Table

    }


    private function insertDefenseBuildingsSpecifics(){
        // Below add Building Specific Information to its respective Table

    }

    private function insertFacilityBuildingsSpecifics(){
        // Below add Building Specific Information to its respective Table

    }
}
