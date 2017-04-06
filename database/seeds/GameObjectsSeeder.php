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
        $b5sy = $this->babylon5Shipyard();
        $bsgsy = $this->battlestarGalacticaShipyard();
        $sgsy = $this->stargateShipyard();

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
        $b5syu = $this->babylon5ShipyardUpgrade();
        $bsgsyu = $this->battlestarGalacticaShipyardUpgrade();
        $sgsyu = $this->stargateShipyardUpgrade();

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
        $b5syp = $this->babylon5ShipyardProduct();
        $bsgsyp = $this->battlestarGalacticaShipyardProduct();
        $sgsyp = $this->stargateShipyardProduct();


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
            $this->createBuildings($planet, $b5sy, $b5syu, $b5syp);
            $this->createBuildings($planet, $bsgsy, $bsgsyu, $bsgsyp);
            $this->createBuildings($planet, $sgsy, $sgsyu, $sgsyp);
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

    private function babylon5Shipyard(){
        $description = new \App\Description();
        $description->name = "babylon5_shipyard";
        $description->display_name = "Babylon 5 Shipyard";
        $description->description = "Increases babylon's capacity for this Planet";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function battlestarGalacticaShipyard()
    {
        $description = new \App\Description();
        $description->name = "battlestarGalactica_shipyard";
        $description->display_name = "Battlestar Galactica Shipyard";
        $description->description = "Increases Battlestar Galactica's capacity for this Planet";
        $description->type = "shipyard";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function stargateShipyard()
    {
        $description = new \App\Description();
        $description->name = "stargate_shipyard";
        $description->display_name = "Stargate Shipyard";
        $description->description = "Increases Stargate's capacity for this Planet";
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

    private function babylon5ShipyardUpgrade()
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

    private function battlestarGalacticaShipyardUpgrade()
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

    private function stargateShipyardUpgrade()
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


    private function babylon5ShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function battlestarGalacticaShipyardProduct()
    {
        $product = new App\Product();
        $product->characteristics = [
            'capacity_base' => 10,
            'capacity_rate' => 1.5,
        ];
        $product->save();
        return $product;
    }

    private function stargateShipyardProduct()
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
        $planets = \App\Planet::all();
        $b5p = $this->babylon5Product();
        $bsgp = $this->battlestarGalacticaProduct();
        $sp = $this->stargateProduct();

        $b5d = $this->babylon5Description();
        $bsgd = $this->battlestarGalacticaDescription();
        $spd = $this->stargateDescription();

        foreach($planets as $planet)
        {
            $this->createFleets($planet, $b5d, $b5p);
            $this->createFleets($planet, $bsgd, $bsgp);
            $this->createFleets($planet, $spd, $sp);
        }
    }

    private function babylon5Product(){
        $product = new App\Product();
        $product->characteristics = [
            'multipliers'=> [
                'babylon5' => 2.0,
                'battlestar_galactica' => 2.0,
                'stargate' => 0.5,
            ],
            'health'=>100,
            'speed'=>55,
            'attack'=>35,
            'defense'=>20
        ];
        $product->save();
        return $product;
    }

    private function battlestarGalacticaProduct(){
        $product = new App\Product();
        $product->characteristics = [
            'multipliers'=> [
                'babylon5' => 0.5,
                'battlestar_galactica' => 1.0,
                'stargate' => 0.5,
            ],
            'health'=>200,
            'speed'=>35,
            'attack'=>55,
            'defense'=>70
        ];
        $product->save();
        return $product;
    }

    private function stargateProduct(){
        $product = new App\Product();
        $product->characteristics = [
            'multipliers'=> [
                'babylon5' => 2.0,
                'battlestar_galactica' => 1.0,
                'stargate' => 1.0,
            ],
            'health'=>80,
            'speed'=>100,
            'attack'=>40,
            'defense'=>20
        ];
        $product->save();
        return $product;
    }

    private function babylon5Description()
    {
        $description = new \App\Description();
        $description->name = "babylon5";
        $description->display_name = "Babylon 5";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function battlestarGalacticaDescription()
    {
        $description = new \App\Description();
        $description->name = "battlestar_galactica";
        $description->display_name = "Battlestar Galactica";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function stargateDescription()
    {
        $description = new \App\Description();
        $description->name = "stargate";
        $description->display_name = "Stargate";
        $description->type = "fleet";
        $description->img_path = "/img/building/aeroplane-with-four-engines.svg";
        $description->save();
        return $description;
    }

    private function createFleets(\App\Planet $planet, \App\Description $description, \App\Product $product){
        $fleet = new App\Fleet();
        $fleet->count = 1;
        $fleet->capacity = 10;
        $fleet->planet()->associate($planet);
        $fleet->description()->associate($description);
        $fleet->product()->associate($product);
        $fleet->save();
    }

}