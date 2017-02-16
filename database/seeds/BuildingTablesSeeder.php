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
        $this->insertResourcesBuildingSpecifics();
        $this->insertFleetBuildingsSpecifics();
        $this->insertDefenseBuildingsSpecifics();
    }


    private function insertResourcesBuildingSpecifics(){
        // Below add Building Specific Information to its respective Table

    }


    private function insertFleetBuildingsSpecifics(){

        // Below add Building Specific Information to its respective Table

    }


    private function insertDefenseBuildingsSpecifics(){
        // Below add Building Specific Information to its respective Table

    }
}
