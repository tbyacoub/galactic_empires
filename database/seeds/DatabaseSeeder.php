<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $mm;
    public $cm;
    public $er;
    public $fs;
    public $am;
    public $pt;
    public $rs;
    public $al;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(EntrustSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->mm = $this->metalMine();
        $this->cm = $this->crystalMine();
        $this->er = $this->energyReactor();
        $this->fs = $this->fleetShipyard();
        $this->am = $this->antiAirMisiles();
        $this->pt = $this->plasmaTurret();
        $this->rs = $this->researchStation();
        $this->al = $this->alloyLab();
        $this->planetSeeder();
        $this->buildingSeeder();
        $this->call(PostsSeeder::class);
        $this->call(MailSeeder::class);
    }

    public function planetSeeder()
    {
        factory(\App\SolarSystem::class, 20)->create();
        factory(\App\PlanetType::class, 5)->create();
        $users = \App\User::all();
        foreach($users as $user){
            $user->planets()->saveMany(factory(\App\Planet::class, 2)->make());
        }
        factory(\App\Planet::class, 'unassigned', 25)->create();
    }

    private function buildingSeeder()
    {
        $planets = \App\Planet::all();

        foreach ($planets as $planet) {
            $this->createBuildings($planet, $this->mm);
            $this->createBuildings($planet, $this->cm);
            $this->createBuildings($planet, $this->er);
            $this->createBuildings($planet, $this->fs);
            $this->createBuildings($planet, $this->am);
            $this->createBuildings($planet, $this->pt);
            $this->createBuildings($planet, $this->rs);
            $this->createBuildings($planet, $this->al);
        }
    }

    private function createBuildings($planet, $description)
    {
        $building = new \App\Building([
            'current_level' => 1,
            'is_upgrading' => false
        ]);
        $planet->buildings()->save($building);
        $building->description()->save($description);
    }

    private function metalMine(){
        $description = new \App\Description();
        $description->name = "metal_mine";
        $description->display_name = "Metal Mine";
        $description->type = "resource";
        $description->img_path = "/img/building/quartz.svg";
        $description->save();
        return $description;
    }

    private function crystalMine(){
        $description = new \App\Description();
        $description->name = "crystal_mine";
        $description->display_name = "Crystal Mine";
        $description->type = "resource";
        $description->img_path = "/img/building/diamond-outlined-shape.svg";
        $description->save();
        return $description;
    }

    private function energyReactor(){
        $description = new \App\Description();
        $description->name = "energy_reactor";
        $description->display_name = "Energy Reactor";
        $description->type = "resource";
        $description->img_path = "/img/building/lightning-electric-energy.svg";
        $description->save();
        return $description;
    }

    private function fleetShipyard(){
        $description = new \App\Description();
        $description->name = "fleet_shipyard";
        $description->display_name = "Fleet Shipyard";
        $description->type = "military";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function antiAirMisiles(){
        $description = new \App\Description();
        $description->name = "anti_air_missile";
        $description->display_name = "Anti-air Missiles";
        $description->type = "planetary_defense";
        $description->img_path = "/img/building/missile.svg";
        $description->save();
        return $description;
    }

    private function plasmaTurret(){
        $description = new \App\Description();
        $description->name = "plasma_turret";
        $description->display_name = "Plasma Turret";
        $description->type = "planetary_defense";
        $description->img_path = "/img/building/machine-gun.svg";
        $description->save();
        return $description;
    }

    private function researchStation(){
        $description = new \App\Description();
        $description->name = "research_station";
        $description->display_name = "Research Station";
        $description->type = "facility";
        $description->img_path = "/img/building/research.svg";
        $description->save();
        return $description;
    }

    private function alloyLab(){
        $description = new \App\Description();
        $description->name = "alloy_lab";
        $description->display_name = "Alloy Lab";
        $description->type = "facility";
        $description->img_path = "/img/building/flask-outline.svg";
        $description->save();
        return $description;
    }


}
