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
		$armOffsetMax = 1.0;
		$rotationFactor = $num_arms;
		$randomOffsetXY = 0.05;
		
		$coords = array();
		
		for ($i = 0; $i < $num_systems; $i++)
		{
			$distance = mt_rand(1, 400) + 20;
			
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
		$num_systems = 500;
		
		$system_coordinates = $this->genGalaxyLocations($num_systems, 4);
		
		for ($i = 0; $i < $num_systems; $i++)
		{
			factory(\App\SolarSystem::class)->create([
				'location' => $system_coordinates[$i]
			]);
		}
		
		$num_planet_types = 5;
		for ($i = 1; $i <= $num_planet_types; $i++)
		{
			factory(\App\PlanetType::class)->create([
				'img_path' => 'img/planet_images/planet_test_image_' . $i . '.png'
			]);
		}
		
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
        $am = $this->antiAirMisiles();
        $pt = $this->plasmaTurret();
        $ms = $this->metalStorage();
        $cs = $this->crystalStorage();
        $es = $this->energyStorage();
        $rs = $this->researchStation();
        $al = $this->alloyLab();
        $fsy = $this->frigateShipyard();
        $csy = $this->corvetteShipyard();
        $dsy = $this->destroyerShipyard();

        $mmu = $this->metalMineUpgrade();
        $cmu = $this->crystalMineUpgrade();
        $eru = $this->energyReactorUpgrade();
        $amu = $this->antiAirMissilesUpgrade();
        $ptu = $this->plasmaTurretUpgrade();
        $msu = $this->metalStorageUpgrade();
        $csu = $this->crystalStorageUpgrade();
        $esu = $this->energyStorageUpgrade();
        $rsu = $this->researchStationUpgrade();
        $alu = $this->alloyLabUpgrade();
        $fsyu = $this->frigateShipyardUpgrade();
        $csyu = $this->corvetteShipyardUpgrade();
        $dsyu = $this->destroyerShipyardUpgrade();

        $mmp = $this->metalMineProduct();
        $cmp = $this->crystalMineProduct();
        $erp = $this->energyReactorProduct();
        $amp = $this->antiAirMisilesProduct();
        $ptp = $this->plasmaTurretProduct();
        $msp = $this->metalStorageProduct();
        $csp = $this->crystalStorageProduct();
        $esp = $this->energyStorageProduct();
        $rsp = $this->researchStationProduct();
        $alp = $this->alloyLabProduct();
        $fsyp = $this->frigateShipyardProduct();
        $csyp = $this->corvetteShipyardProduct();
        $dsyp = $this->destroyerShipyardProduct();


        foreach ($planets as $planet) {
            $this->createBuildings($planet, $mm, $mmu, $mmp);
            $this->createBuildings($planet, $cm, $cmu, $cmp);
            $this->createBuildings($planet, $er, $eru, $erp);
            $this->createBuildings($planet, $am, $amu, $amp);
            $this->createBuildings($planet, $pt, $ptu, $ptp);
            $this->createBuildings($planet, $rs, $rsu, $rsp);
            $this->createBuildings($planet, $al, $alu, $alp);
            $this->createBuildings($planet, $ms, $msu, $msp);
            $this->createBuildings($planet, $cs, $csu, $csp);
            $this->createBuildings($planet, $es, $esu, $esp);
            $this->createBuildings($planet, $fsy, $fsyu, $fsyp);
            $this->createBuildings($planet, $csy, $csyu, $csyp);
            $this->createBuildings($planet, $dsy, $dsyu, $dsyp);
        }
    }

    /**
     * CREATE BUILDINGS START
     */

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

    private function metalStorage()
    {
        $description = new \App\Description();
        $description->name = 'metal_storage';
        $description->display_name = 'Metal Storage';
        $description->type = 'facility';
        $description->img_path = '/img/building/metal-storage.svg';
        $description->save();
        return $description;
    }

    private function crystalStorage()
    {
        $description = new \App\Description();
        $description->name = 'crystal_storage';
        $description->display_name = 'Crystal Storage';
        $description->type = 'facility';
        $description->img_path = '/img/building/crystal-storage.svg';
        $description->save();
        return $description;
    }

    private function energyStorage()
    {
        $description = new \App\Description();
        $description->name = 'energy_storage';
        $description->display_name = 'Energy Plant';
        $description->type = 'facility';
        $description->img_path = '/img/building/energy-plant.svg';
        $description->save();
        return $description;
    }

    private function researchStation(){
        $description = new \App\Description();
        $description->name = "research_station";
        $description->display_name = "Research Station";
        $description->type = "research";
        $description->img_path = "/img/building/research.svg";
        $description->save();
        return $description;
    }

    private function alloyLab(){
        $description = new \App\Description();
        $description->name = "alloy_lab";
        $description->display_name = "Alloy Lab";
        $description->type = "research";
        $description->img_path = "/img/building/flask-outline.svg";
        $description->save();
        return $description;
    }

    private function frigateShipyard(){
        $description = new \App\Description();
        $description->name = "frigate_shipyard";
        $description->display_name = "Frigates Shipyard";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function corvetteShipyard()
    {
        $description = new \App\Description();
        $description->name = "corvette_shipyard";
        $description->display_name = "Corvettes Shipyard";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function destroyerShipyard()
    {
        $description = new \App\Description();
        $description->name = "destroyer_shipyard";
        $description->display_name = "Destroyers Shipyard";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    /**
     * UPGRADES START
     */

    private function metalMineUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
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
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
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
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
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
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
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
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    private function metalStorageUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    private function crystalStorageUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    private function energyStorageUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
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
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
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
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    private function frigateShipyardUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    private function corvetteShipyardUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    private function destroyerShipyardUpgrade()
    {
        $upgrade = new App\Upgrade();
        $upgrade->max_level = 10;
        $upgrade->base_metal = 100;
        $upgrade->base_crystal = 100;
        $upgrade->base_energy = 100;
        $upgrade->rate_metal = 2;
        $upgrade->rate_crystal = 2;
        $upgrade->rate_energy = 2;
        $upgrade->base_minutes = 1;
        $upgrade->rate_minutes = 2;
        $upgrade->save();
        return $upgrade;
    }

    /**
     * PRODUCTS START
     */

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

    private function metalStorageProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'storage_base_rate'=> 2,
            'storage_base'=> 2500,
        ];
        $product->save();
        return $product;
    }

    private function crystalStorageProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'storage_base_rate'=> 2,
            'storage_base'=> 2500,
        ];
        $product->save();
        return $product;
    }

    private function energyStorageProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'storage_base_rate'=> 2,
            'storage_base'=> 2500,
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


    private function frigateShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'attack_bonus' => 1.15,
            'health_bonus' => 1.15,
        ];
        $product->save();
        return $product;
    }

    private function corvetteShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'attack_bonus' => 1.1,
            'health_bonus' => 1.1,
        ];
        $product->save();
        return $product;
    }

    private function destroyerShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'attack_bonus' => 1.05,
            'health_bonus' => 1.05,
        ];
        $product->save();
        return $product;
    }


    private function fleetSeeder()
    {
        $planets = \App\Planet::all();
        $fighter = $this->fighter();
        $bomber = $this->bomber();
        $corvette = $this->corvette();
        $frigate = $this->frigate();
        $destroyer = $this->destroyer();

        foreach($planets as $planet)
        {
            $this->createFleets($fighter);
            $this->createFleets($bomber);
            $this->createFleets($corvette);
            $this->createFleets($frigate);
            $this->createFleets($destroyer);
        }
    }

    private function fighter(Planet $planet)
    {
        $fighter = new App\Fleet();
        $fighter->planet_id = $planet->id;
        $fighter->type = 'fighter';
        $fighter->health = 100;
        $fighter->speed = 55;
        $fighter->attack = 35;
        $fighter->defence = 20;
        $fighter->multipliers = [
            'Fighter' => 2.0,
            'Bomber' => 2.0,
            'Corvette' => 0.5,
            'Frigate' => 0.5,
            'Destroyer' => 0.5,
        ];
        $fighter->decription()->associate($this->fighterDescription());
        $fighter->save();
    }

    private function bomber(Planet $planet)
    {
        $bomber = new App\Fleet();
        $bomber->planet_id = $planet->id;
        $bomber->type = 'bomber';
        $bomber->health = 200;
        $bomber->speed = 35;
        $bomber->attack = 55;
        $bomber->defence = 70;
        $bomber->multipliers = [
            'Fighter' => 0.5,
            'Bomber' => 1.0,
            'Corvette' => 0.5,
            'Frigate' => 2.0,
            'Destroyer' => 2.0,
        ];
        $bomber->decription()->associate($this->bomberDescription());
        $bomber->save();
    }

    private function corvette(Planet $planet)
    {
        $corvette = new App\Fleet();
        $corvette->planet_id = $planet->id;
        $corvette->type = 'corvette';
        $corvette->health = 80;
        $corvette->speed = 100;
        $corvette->attack = 40;
        $corvette->defence = 20;
        $corvette->multipliers = [
            'Fighter' => 2.0,
            'Bomber' => 1.0,
            'Corvette' => 1.0,
            'Frigate' => 0.5,
            'Destroyer' => 2.0,
        ];
        $corvette->decription()->associate($this->corvetteDescription());
        $corvette->save();
    }

    private function frigate(Planet $planet)
    {
        $frigate = new App\Fleet();
        $frigate->planet_id = $planet->id;
        $frigate->type = 'frigate';
        $frigate->health = 325;
        $frigate->speed = 40;
        $frigate->attack = 70;
        $frigate->defence = 70;
        $frigate->multipliers = [
            'Fighter' => 2.0,
            'Bomber' => 0.5,
            'Corvette' => 1.0,
            'Frigate' => 1.0,
            'Destroyer' => 0.5,
        ];
        $frigate->decription()->associate($this->frigateDescription());
        $frigate->save();
    }

    private function destroyer(Planet $planet)
    {
        $destroyer = new App\Fleet();
        $destroyer->planet_id = $planet->id;
        $destroyer->type = 'destroyer';
        $destroyer->health = 400;
        $destroyer->speed = 35;
        $destroyer->attack = 100;
        $destroyer->defence = 90;
        $destroyer->multipliers = [
            'Fighter' => 0.5,
            'Bomber' => 2.0,
            'Corvette' => 0.5,
            'Frigate' => 2.0,
            'Destroyer' => 2.0,
        ];
        $destroyer->decription()->associate($this->destroyerDescription());
        $destroyer->save();
    }

    private function fighterDescription()
    {
        $description = new \App\Description();
        $description->name = "fighter";
        $description->display_name = "Fighter";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function bomberDescription()
    {
        $description = new \App\Description();
        $description->name = "bomber";
        $description->display_name = "Bomber";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function corvetteDescription()
    {
        $description = new \App\Description();
        $description->name = "corvette";
        $description->display_name = "Corvette";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function frigateDescription()
    {
        $description = new \App\Description();
        $description->name = "frigate";
        $description->display_name = "Frigate";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function destroyerDescription()
    {
        $description = new \App\Description();
        $description->name = "destroyer";
        $description->display_name = "Destroyer";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }
}
