<?php

use Illuminate\Database\Seeder;

class GameObjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->planetSeeder();
        $this->buildingSeeder();
    }
	
	private function genGalaxyLocations($num_systems, $num_arms)
	{
		// Random seed.
		mt_srand(10);
		
		$armSeparationDistance = 2 * M_PI / $num_arms;
		$armOffsetMax = 0.5;
		$rotationFactor = $num_arms;
		$randomOffsetXY = 0.02;
		
		$coords = array();
		
		for ($i = 0; $i < $num_systems; $i++)
		{
			$distance = mt_rand(1, 480);
			
			$angle = ((float)mt_rand() / (float)mt_getrandmax()) * 2.0 * M_PI;
			$armOffset = ((float)mt_rand() / (float)mt_getrandmax()) * $armOffsetMax;
			$armOffset = $armOffset - $armOffsetMax / 2;
			$armOffset = $armOffset * (1.0 / (float)$distance);
			
			$squaredArmOffset = pow($armOffset, 2);
			if ($armOffset < 0)
			{
				$squaredArmOffset = $squaredArmOffset * -1.0;
			}
			$armOffset = $squaredArmOffset;
			
			$rotation = (float)$distance * (float)$rotationFactor;
			
			$angle = (int)($angle / $armSeparationDistance) * $armSeparationDistance + $armOffset + $rotation;
			
			// Convert polar to cartesion coordinates.
			$systemX = cos($angle) * $distance;
			$systemY = sin($angle) * $distance;
			
			$randomOffsetX = ((float)mt_rand() / (float)mt_getrandmax()) * $randomOffsetXY;
			$randomOffsetY = ((float)mt_rand() / (float)mt_getrandmax()) * $randomOffsetXY;
			
			$systemX += $randomOffsetX;
			$systemY += $randomOffsetY;
			
			$system_coord = array();
			array_push($system_coord, $systemX);
			array_push($system_coord, $systemY);
			
			array_push($coords, $system_coord);
		}
		
		return $coords;
	}

    public function planetSeeder()
    {
		
		
        factory(\App\SolarSystem::class, 20)->create()->each(function($s)
		{
			
		});
		
		
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
        $mm = $this->metalMine();
        $cm = $this->crystalMine();
        $er = $this->energyReactor();
        $fs = $this->fleetShipyard();
        $am = $this->antiAirMisiles();
        $pt = $this->plasmaTurret();
        $rs = $this->researchStation();
        $al = $this->alloyLab();
        $mmu = $this->metalMineUpgrade();
        $cmu = $this->crystalMineUpgrade();
        $eru = $this->energyReactorUpgrade();
        $fsu = $this->fleetShipyardUpgrade();
        $amu = $this->antiAirMissilesUpgrade();
        $ptu = $this->plasmaTurretUpgrade();
        $rsu = $this->researchStationUpgrade();
        $alu = $this->alloyLabUpgrade();
        $mmp = $this->metalMineProduct();
        $cmp = $this->crystalMineProduct();
        $erp = $this->energyReactorProduct();
        $fsp = $this->fleetShipyardProduct();
        $amp = $this->antiAirMisilesProduct();
        $ptp = $this->plasmaTurretProduct();
        $rsp = $this->researchStationProduct();
        $alp = $this->alloyLabProduct();

        foreach ($planets as $planet) {
            $this->createBuildings($planet, $mm, $mmu, $mmp);
            $this->createBuildings($planet, $cm, $cmu, $cmp);
            $this->createBuildings($planet, $er, $eru, $erp);
            $this->createBuildings($planet, $fs, $fsu, $fsp);
            $this->createBuildings($planet, $am, $amu, $amp);
            $this->createBuildings($planet, $pt, $ptu, $ptp);
            $this->createBuildings($planet, $rs, $rsu, $rsp);
            $this->createBuildings($planet, $al, $alu, $alp);
        }
    }

    private function createBuildings($planet, $description, $upgrade, $product)
    {
        $building = new \App\Building([
            'current_level' => 1,
            'is_upgrading' => false
        ]);
        $building->description()->associate($description);
        $building->upgrade()->associate($description);
        $building->product()->associate($product);
        $planet->buildings()->save($building);
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
    //
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
        $upgrade->save();
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
        $upgrade->save();
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
        $upgrade->save();
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
        $upgrade->save();
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
        $upgrade->save();
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
        $upgrade->save();
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
        $upgrade->save();
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
        $upgrade->save();
        return $upgrade;
    }

    private function metalMineProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function crystalMineProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function energyReactorProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function fleetShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function antiAirMisilesProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function plasmaTurretProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function researchStationProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }

    private function alloyLabProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=>5.0,
            'energy_base_rate'=>10.0,
        ];
        $product->save();
        return $product;
    }
}
