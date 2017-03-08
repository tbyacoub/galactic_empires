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
        $this->metalMine($faker);
        $this->crystalMine($faker);
        $this->energyReactor($faker);
        $this->fleetShipyard($faker);
        $this->antiAirMisiles($faker);
        $this->plasmaTurret($faker);
        $this->researchStation($faker);
        $this->alloyLab($faker);
    }

    private function metalMine($faker){
        $building = new \App\Building();
        $building->name = "metal_mine";
        $building->display_name = "Metal Mine";
        $building->type = "resource";
        $building->img_path = "/img/building/quartz.svg";
        $building->save();
        $building->products()->save($this->metalMineProduct());
        $building->upgrades()->save($this->metalMineUpgrade());
    }

    private function crystalMine($faker){
        $building = new \App\Building();
        $building->name = "crystal_mine";
        $building->display_name = "Crystal Mine";
        $building->type = "resource";
        $building->img_path = "/img/building/diamond-outlined-shape.svg";
        $building->save();
        $building->products()->save($this->crystalMineProduct());
        $building->upgrades()->save($this->crystalMineUpgrade());
    }

    private function energyReactor($faker){
        $building = new \App\Building();
        $building->name = "energy_reactor";
        $building->display_name = "Energy Reactor";
        $building->type = "resource";
        $building->img_path = "/img/building/lightning-electric-energy.svg";
        $building->save();
        $building->products()->save($this->energyReactorProduct());
        $building->upgrades()->save($this->energyReactorUpgrade());

    }

    private function fleetShipyard($faker){
        $building = new \App\Building();
        $building->name = "fleet_shipyard";
        $building->display_name = "Fleet Shipyard";
        $building->type = "military";
        $building->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $building->save();
        $building->upgrades()->save($this->fleetShipyardUpgrade($building->id));
    }

    /**
     * @param $faker
     */
    private function antiAirMisiles($faker){
        $building = new \App\Building();
        $building->name = "anti_air_missile";
        $building->display_name = "Anti-air Missiles";
        $building->type = "planetary_defense";
        $building->img_path = "/img/building/missile.svg";
        $building->save();
        $building->upgrades()->save($this->antiAirMissilesUpgrade());
    }

    private function plasmaTurret($faker){
        $building = new \App\Building();
        $building->name = "plasma_turret";
        $building->display_name = "Plasma Turret";
        $building->type = "planetary_defense";
        $building->img_path = "/img/building/machine-gun.svg";
        $building->save();
        $building->upgrades()->save($this->plasmaTurretUpgrade());
    }

    private function researchStation($faker){
        $building = new \App\Building();
        $building->name = "research_station";
        $building->display_name = "Research Station";
        $building->type = "facility";
        $building->img_path = "/img/building/research.svg";
        $building->save();
        $building->upgrades()->save($this->researchStationUpgrade());
    }

    private function alloyLab($faker){
        $building = new \App\Building();
        $building->name = "alloy_lab";
        $building->display_name = "Alloy Lab";
        $building->type = "facility";
        $building->img_path = "/img/building/flask-outline.svg";
        $building->save();
        $building->upgrades()->save($this->alloyLabUpgrade());
    }

    public function metalMineProduct()
    {
        $metalMine = new App\Product();
        $metalMine->production_rate = 1.20;
        $metalMine->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $metalMine->producible_type = 'resources';
        $metalMine->production_rate = 1.0;
        return $metalMine;
    }

    public function crystalMineProduct()
    {
        $crystalMine = new App\Product();
        $crystalMine->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $crystalMine->producible_type = 'resources';
        $crystalMine->production_rate = 1.0;
        return $crystalMine;
    }

    public function energyReactorProduct()
    {
        $energyReactor = new App\Product();
        $energyReactor->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $energyReactor->producible_type = 'resources';
        $energyReactor->production_rate = 1.0;
        return $energyReactor;
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
