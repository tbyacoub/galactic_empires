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
        $this->fleetSeeder();
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
        $am = $this->antiAirMissiles();
        $pt = $this->plasmaTurret();
        $ms = $this->metalStorage();
        $cs = $this->crystalStorage();
        $es = $this->energyStorage();
        $rs = $this->researchStation();
        $al = $this->alloyLab();
        $fsy = $this->frigateShipyard();
        $csy = $this->corvetteShipyard();
        $dsy = $this->destroyerShipyard();
        $fisy = $this->fighterShipyard();
        $bsy = $this->bomberShipyard();

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
        $fisyu = $this->fighterShipyardUpgrade();
        $bsyu = $this->bomberShipyardUpgrade();

        $mmp = $this->metalMineProduct();
        $cmp = $this->crystalMineProduct();
        $erp = $this->energyReactorProduct();
        $amp = $this->antiAirMissilesProduct();
        $ptp = $this->plasmaTurretProduct();
        $msp = $this->metalStorageProduct();
        $csp = $this->crystalStorageProduct();
        $esp = $this->energyStorageProduct();
        $rsp = $this->researchStationProduct();
        $alp = $this->alloyLabProduct();
        $fsyp = $this->frigateShipyardProduct();
        $csyp = $this->corvetteShipyardProduct();
        $dsyp = $this->destroyerShipyardProduct();
        $fisyp = $this->fighterShipyardProduct();
        $bsyp = $this->bomberShipyardProduct();


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
            $this->createBuildings($planet, $fisy, $fisyu, $fisyp);
            $this->createBuildings($planet, $bsy, $bsyu, $bsyp);
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
        $description->description = "Produces metal over time";
        $description->type = "resource";
        $description->img_path = "/img/building/quartz.svg";
        $description->save();
        return $description;
    }

    private function crystalMine(){
        $description = new \App\Description();
        $description->name = "crystal_mine";
        $description->display_name = "Crystal Mine";
        $description->description = "Produces crystal over time";
        $description->type = "resource";
        $description->img_path = "/img/building/diamond-outlined-shape.svg";
        $description->save();
        return $description;
    }

    private function energyReactor(){
        $description = new \App\Description();
        $description->name = "energy_reactor";
        $description->display_name = "Energy Reactor";
        $description->description = "Produces energy over time";
        $description->type = "resource";
        $description->img_path = "/img/building/lightning-electric-energy.svg";
        $description->save();
        return $description;
    }

    private function antiAirMissiles(){
        $description = new \App\Description();
        $description->name = "anti_air_missile";
        $description->display_name = "Anti-air Missiles";
        $description->description = "Defends Planet against enemy attacks";
        $description->type = "planetary_defense";
        $description->img_path = "/img/building/missile.svg";
        $description->save();
        return $description;
    }

    private function plasmaTurret(){
        $description = new \App\Description();
        $description->name = "plasma_turret";
        $description->display_name = "Plasma Turret";
        $description->description = "Defends Planet against enemy attacks";
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
        $description->description = "Increases Storage capacity for metal";
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
        $description->description = "Increases Storage capacity for crystal";
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
        $description->description = "Increases Storage capacity for energy";
        $description->type = 'facility';
        $description->img_path = '/img/building/energy-plant.svg';
        $description->save();
        return $description;
    }

    private function researchStation(){
        $description = new \App\Description();
        $description->name = "research_station";
        $description->display_name = "Research Station";
        $description->description = "Provides bonuses for Fleets";
        $description->type = "research";
        $description->img_path = "/img/building/research.svg";
        $description->save();
        return $description;
    }

    private function alloyLab(){
        $description = new \App\Description();
        $description->name = "alloy_lab";
        $description->display_name = "Alloy Lab";
        $description->description = "Provides bonuses for Resources";
        $description->type = "research";
        $description->img_path = "/img/building/flask-outline.svg";
        $description->save();
        return $description;
    }

    private function frigateShipyard(){
        $description = new \App\Description();
        $description->name = "frigate_shipyard";
        $description->display_name = "Frigates Shipyard";
        $description->description = "Increases Frigate's capacity for this Planet";
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
        $description->description = "Increases Corvette's capacity for this Planet";
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
        $description->description = "Increases Destroyer's capacity for this Planet";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function fighterShipyard()
    {
        $description = new \App\Description();
        $description->name = "fighter_shipyard";
        $description->display_name = "Fighters Shipyard";
        $description->description = "Increases Fighter's capacity for this Planet";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function bomberShipyard()
    {
        $description = new \App\Description();
        $description->name = "bomber_shipyard";
        $description->display_name = "Bombers Shipyard";
        $description->description = "Increases Bomber's capacity for this Planet";
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

    private function fighterShipyardUpgrade()
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

    private function bomberShipyardUpgrade()
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
            'crystal_base_rate'=> 25.0,
            'energy_base_rate'=> 10.0,
        ];
        $product->save();
        return $product;
    }

    private function crystalMineProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=> 25.0,
            'energy_base_rate'=> 10.0,
        ];
        $product->save();
        return $product;
    }

    private function energyReactorProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_base_rate'=> 35.0,
            'crystal_base_rate'=> 25.0,
            'energy_base_rate'=> 10.0,
        ];
        $product->save();
        return $product;
    }

    private function antiAirMissilesProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'base_attack' => 3500,
            'base_attack_rate' => 1.10,
        ];
        $product->save();
        return $product;
    }

    private function plasmaTurretProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'base_attack'=> 5000,
            'base_attack_rate' => 1.05,
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
            'metal_bonus_rate' => 0.05,
            'crystal_bonus_rate' => 0.05,
            'energy_bonus_rate' => 0.05,
        ];
        $product->save();
        return $product;
    }

    private function alloyLabProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'metal_bonus_rate'=> 0.15,
        ];
        $product->save();
        return $product;
    }


    private function frigateShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function corvetteShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function destroyerShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function fighterShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function bomberShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function fleetSeeder()
    {
       // $fighterDescription = $this->fighterDescription();
       // $bomberDescription = $this->bomberDescription();
       // $corvetteDescription = $this->corvetteDescription();
       // $frigate = $this->frigateDescription();
       // $destroyer = $this->destroyerDescription();

       $this->bomber();
       $this->fighter();
       $this->frigate();
       $this->corvette();
       $this->destroyer();
    }

    private function fighter()
    {
        $fighter = new App\Fleet();
        // $fighter->planet_id = $planet->id;
        $fighter->type = 'fighter';
        $fighter->health = 100;
        $fighter->speed = 55;
        $fighter->attack = 3500;
        $fighter->defence = 20;
        $fighter->multipliers = [
            'fighter' => 2.0,
            'bomber' => 2.0,
            'corvette' => 0.5,
            'frigate' => 0.5,
            'destroyer' => 0.5
        ];
        $fighter->description()->associate($this->fighterDescription());
        $fighter->save();
    }

    private function bomber()
    {
        $bomber = new App\Fleet();
        // $bomber->planet_id = $planet->id;
        $bomber->type = 'bomber';
        $bomber->health = 200;
        $bomber->speed = 35;
        $bomber->attack = 5500;
        $bomber->defence = 70;
        $bomber->multipliers = [
            'fighter' => 0.5,
            'bomber' => 1.0,
            'corvette' => 0.5,
            'frigate' => 2.0,
            'destroyer' => 2.0
        ];
        $bomber->description()->associate($this->bomberDescription());
        $bomber->save();
    }

    private function corvette()
    {
        $corvette = new App\Fleet();
        // $corvette->planet_id = $planet->id;
        $corvette->type = 'corvette';
        $corvette->health = 80;
        $corvette->speed = 100;
        $corvette->attack = 4000;
        $corvette->defence = 20;
        $corvette->multipliers = [
            'fighter' => 2.0,
            'bomber' => 1.0,
            'corvette' => 1.0,
            'frigate' => 0.5,
            'destroyer' => 2.0
        ];
        $corvette->description()->associate($this->corvetteDescription());
        $corvette->save();
    }

    private function frigate()
    {
        $frigate = new App\Fleet();
        // $frigate->planet_id = $planet->id;
        $frigate->type = 'frigate';
        $frigate->health = 325;
        $frigate->speed = 40;
        $frigate->attack = 7000;
        $frigate->defence = 70;
        $frigate->multipliers = [
            'fighter' => 2.0,
            'bomber' => 0.5,
            'corvette' => 1.0,
            'frigate' => 1.0,
            'destroyer' => 0.5
        ];
        $frigate->description()->associate($this->frigateDescription());
        $frigate->save();
    }

    private function destroyer()
    {
        $destroyer = new App\Fleet();
        // $destroyer->planet_id = $planet->id;
        $destroyer->type = 'destroyer';
        $destroyer->health = 400;
        $destroyer->speed = 35;
        $destroyer->attack = 10000;
        $destroyer->defence = 90;
        $destroyer->multipliers = [
            'fighter' => 0.5,
            'bomber' => 2.0,
            'corvette' => 0.5,
            'frigate' => 2.0,
            'destroyer' => 2.0
        ];

        $destroyer->description()->associate($this->destroyerDescription());
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
