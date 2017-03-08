<?php

use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    }



    public function metalMineProduct()
    {
        $metalMine = new App\Product();
        $metalMine->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $metalMine->production_rate = 1.0;
        return $metalMine;
    }

    public function crystalMineProduct()
    {
        $metalMine = new App\Product();
        $metalMine->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $metalMine->production_rate = 1.0;
        return $metalMine;
    }

    public function energyReactorProduct()
    {
        $metalMine = new App\Product();
        $metalMine->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $metalMine->production_rate = 1.0;
        return $metalMine;
    }

    private function metalMineUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function crystalMineUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function energyReactorUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function fleetShipyardUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function antiAirMissilesUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function plasmaTurretUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function researchStationUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }

    private function alloyLabUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 1;
        $upgrade->rate_crystal = 1;
        $upgrade->rate_energy = 1;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 1;

        return $upgrade;
    }
}
