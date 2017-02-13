<?php

use Illuminate\Database\Seeder;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\SolarSystem::class, 20)->create();
        factory(\App\PlanetType::class, 5)->create();
        factory(\App\Planet::class, 100)->create();
        factory(\App\Planet::class, 'unassigned', 25)->create();
    }
}
