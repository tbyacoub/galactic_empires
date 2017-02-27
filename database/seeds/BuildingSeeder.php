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
        $this->plasmaTurent($faker);
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
        $mine = $this->metalMineProduct()->producible()->save($building);
    }

    private function crystalMine($faker){
        $building = new \App\Building();
        $building->name = "crystal_mine";
        $building->display_name = "Crystal Mine";
        $building->type = "resource";
        $building->img_path = "/img/building/diamond-outlined-shape.svg";
        $building->save();
    }

    private function energyReactor($faker){
        $building = new \App\Building();
        $building->name = "energy_reactor";
        $building->display_name = "Energy Reactor";
        $building->type = "resource";
        $building->img_path = "/img/building/lightning-electric-energy.svg";
        $building->save();
    }

    private function fleetShipyard($faker){
        $building = new \App\Building();
        $building->name = "fleet_shipyard";
        $building->display_name = "Fleet Shipyard";
        $building->type = "military";
        $building->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $building->save();
    }

    private function antiAirMisiles($faker){
        $building = new \App\Building();
        $building->name = "anti_air_missile";
        $building->display_name = "Anti-air Missiles";
        $building->type = "planetery_defense";
        $building->img_path = "/img/building/missile.svg";
        $building->save();
    }

    private function plasmaTurent($faker){
        $building = new \App\Building();
        $building->name = "plasma_turret";
        $building->display_name = "Plasma Turret";
        $building->type = "planetery_defense";
        $building->img_path = "/img/building/machine-gun.svg";
        $building->save();
    }

    private function researchStation($faker){
        $building = new \App\Building();
        $building->name = "research_station";
        $building->display_name = "Research Station";
        $building->type = "facility";
        $building->img_path = "/img/building/research.svg";
        $building->save();
    }

    private function alloyLab($faker){
        $building = new \App\Building();
        $building->name = "alloy_lab";
        $building->display_name = "Alloy Lab";
        $building->type = "facility";
        $building->img_path = "/img/building/flask-outline.svg";
        $building->save();
    }

  public function metalMineProduct()
    {
        $metalMine = new App\Product();
        $metalMine->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        return $metalMine;
    }

    public function crystalMineProduct()
    {
        $cyrstalMine = new App\Product();
        $crystalMine->characteristics = [
            'metal_base_rate'=>10.0,
            'crystal_base_rate'=>15.0,
            'energy_base_rate'=>8.0,
        ];
        return $crystalMine;
    }

    public function energyReactorProduct()
    {
        $energyReactor = new App\Product();
        $energyReactor->characteristics = [
            'metal_base_rate'=>5.0,
            'crystal_base_rate'=>1.0,
            'energy_base_rate'=>75.0,
        ];
        return $energyReactor;
    }
}


